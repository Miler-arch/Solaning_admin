<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'ci' => '123456789',
            'lastname' => 'admin',
            'phone' => '123456789',
            'password' => bcrypt('admin'),
        ])->assignRole('superAdmin');
    }
}
