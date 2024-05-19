<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $categories = [
            [
                'name' => 'Category 1',
            ],
            [
                'name' => 'Category 2',
            ],
            [
                'name' => 'Category 3',
            ],            
            [
                'name' => 'Category 4',
            ],
            [
                'name' => 'Category 5',
            ],                        
        ];

        Category::insert($categories);
    }
}
