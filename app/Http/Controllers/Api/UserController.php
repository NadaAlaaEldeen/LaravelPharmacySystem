<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUsersPostRequest;
use App\Models\User;
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

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'gender' => $gender,
            'password' => Hash::make($password),
            'birth_day' => $dateOfBirth,
            'avatar' => $avater,
            'mobile' => $mobile,
            'national_id' => $national_id
        ]);
        event(new Registered($user));
        return 'done';
    }
}
