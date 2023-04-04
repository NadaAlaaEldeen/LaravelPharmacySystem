<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456'), // password
            'remember_token'  => now(),
        ])->assignRole('admin');

        //fack data for clients
        User::factory(5)->create()->each(function($user){
            $user->assignRole('client');
        });

        //fack data for doctors
        User::factory(5)->create()->each(function($user){
            $user->assignRole('doctor');
        });
        
        User::factory(5)->create()->each(function($user){
            $user->assignRole('pharmacy');
        });
    }
}
