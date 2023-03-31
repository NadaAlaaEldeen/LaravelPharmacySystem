<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUsersPostRequest;
use App\Models\User;
use App\Models\Client;
use Illuminate\Auth\Events\Registered;

class UserController extends Controller
{
    public function store(StoreUsersPostRequest $request) //type hinting
    {
        $name = request()->name;
        $email = request()->email;
        $gender = request()->gender;
        $password = request()->password;
        $dateOfBirth = request()->birth_day;
        $avater = request()->avatar;
        $mobile = request()->mobile;
        $national_id = request()->national_id;
        $is_inquired = request()->is_inquired;

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'gender' => $gender,
            'password' => Hash::make($password),
            'birth_day' => $dateOfBirth,
            'avatar' => $avater,
            'mobile' => $mobile,
            'national_id' => $national_id,
            'role' => 'Client'
        ]);
        Client::create([
            'user_id' => $user->id,
            'is_inquired' => $is_inquired
        ]);
        event(new Registered($user));
        return 'done';
    }
}
