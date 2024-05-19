<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $roles = [
            [
                'id' => 1,
                'title' => 'Administrator',
            ],
            [
                'id' => 2,
                'title' => 'User',
            ],
        ];

        Role::insert($roles);
    }
}
