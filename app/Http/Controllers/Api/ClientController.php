<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUsersPostRequest;
use App\Models\User;
use App\Models\Client;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\VerifiesEmails;
use App\Http\Resources\UserResources;

class ClientController extends Controller
{
    use VerifiesEmails;
    public function store(StoreUsersPostRequest $request) //type hinting
    {
        $name = request()->name;
        $email = request()->email;
        $gender = request()->gender;
        $password = request()->password;
        $dateOfBirth = request()->birth_day;
        $avatar = request()->avatar;
        $mobile = request()->mobile;
        $national_id = request()->national_id;
        $is_inquired = request()->is_inquired;

        // $new_name = time() . '.' . $avatar->getClientOriginalExtension();
        // $avatar->move(public_path('images/clients'), $new_name);

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'gender' => $gender,
            'password' => Hash::make($password),
            'birth_day' => $dateOfBirth,
            'avatar' => $avatar,
            'mobile' => $mobile,
            'national_id' => $national_id,
            'role' => 'Client'
        ]);
        $user = $user->refresh();
        $success['message'] = 'the verification email sent to you Please click on verify user button on this mail';

        event(new Registered($user));
        // Client::create([
        //     'user_id' => $user->id,
        //     'is_inquired' => $is_inquired
        // ]);

        return response()->json([
            'success' => $success,
            'Data' => new UserResources($user)
        ], 201);
    }
    public function update($id, Request $request)
    {
        $user = User::findOrFail($id);

        $user->name = request()->name;
        $user->gender = request()->gender;
        $user->password = request()->password;
        $user->birth_day = request()->birth_day;
        $user->avatar = request()->avatar;
        $user->mobile = request()->mobile;
        $user->national_id = request()->national_id;

        $new_name = time() . '.' . $request()->avatar->getClientOriginalExtension();
        $request()->avatar->move(public_path('images/clients'), $new_name);

        $client = Client::where('user_id', $user->id)->first();
        $client->is_inquired = request()->is_inquired;

        $user->update();
        $client->update();
        return response()->json([
            'success' => 'User was updated successfully',
            'Data' => new UserResources($user)
        ], 200);
    }
}
