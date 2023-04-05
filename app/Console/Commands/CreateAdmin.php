<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;


class CreateAdmin extends Command
{
    protected $signature = 'create:admin --email={email} --password={password} --name={name}';

    protected $description = 'Create a new admin user';

    public function handle()
    {
        $email = $this->argument('email');
        $password = $this->argument('password');
        $name = $this->argument('name');

        $user = new User;
        $user->email = $email;
        $user->name =$name;
        $user->password = bcrypt($password);
        $user->save();

        $user->assignRole('admin');

        $this->info('Admin user created successfully!');
    }
}
