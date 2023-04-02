<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Http\Request;
use App\Notifications\greetingNotification;
use PhpParser\Node\Expr\Cast\Object_;

class VerificationController extends Controller
{
    public function verify(Request $request)
    {
        $user = User::findOrFail($request->id);

        if (!hash_equals(sha1($user->getEmailForVerification()), (string) request()->hash)) {
            return false;
        }
        $user->markEmailAsVerified();
        $user->notify(new greetingNotification());
        return (new MailMessage)
            ->greeting('Hello!')
            ->line('Welcome, your email has verified successufully')
            ->action('Login', url('/login'))
            ->line('Thank you for registering in our application!');
    }

    public function resend(Request $request)
    {
        $user = User::find($request->id);
        if ($user->email_verified_at) {
            return response()->json('User already have verified email!', 422);
        }
        $user->sendEmailVerificationNotification();
        return response()->json('The notification has been resubmitted');
    }
}
