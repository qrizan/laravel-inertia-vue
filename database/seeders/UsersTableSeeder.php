<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Administrator',
                'email' => 'administrator@mail.com',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'User',
                'email' => 'user@mail.com',
                'password' => bcrypt('password')
            ]
        ];

        User::insert($users);
    }
}
