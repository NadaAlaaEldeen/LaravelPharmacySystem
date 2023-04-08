<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\UserNotLoggedInNotification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class NotifyUsersNotLoggedInForMonth extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:users-not-logged-in-for-month';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notifications to users who did not log in for the past month';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $users = User::where('last_login', '<', Carbon::now()->subMonth())->get();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new UserNotLoggedInNotification());
        }
        $this->info("Emails sent to " . $users->count() . " users.");
    }
}
