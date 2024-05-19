<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'title' => 'role_create',
            ],
            [
                'title' => 'role_edit',
            ],
            [
                'title' => 'role_show',
            ],
            [
                'title' => 'role_delete',
            ],
            [
                'title' => 'role_access',
            ],
            [
                'title' => 'product_create',
            ],
            [
                'title' => 'product_edit',
            ],
            [
                'title' => 'product_show',
            ],
            [
                'title' => 'product_delete',
            ],
            [
                'title' => 'product_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
