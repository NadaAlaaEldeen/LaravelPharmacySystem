<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Admin = Role::create(['name' => 'admin']);
        $Client = Role::create(['name' => 'client']);
        $Doctor = Role::create(['name' => 'doctor']);
        $Pharmacy = Role::create(['name' => 'pharmacy']);

    }
}
