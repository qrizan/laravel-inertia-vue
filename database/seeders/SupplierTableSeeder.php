<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            [
                'name' => 'Supplier 1',
                'phone' => '098123123123'
            ],
            [
                'name' => 'Supplier 2',
                'phone' => '098123123123'
            ],
            [
                'name' => 'Supplier 3',
                'phone' => '098123123123'
            ],            
            [
                'name' => 'Supplier 4',
                'phone' => '098123123123'
            ],
            [
                'name' => 'Supplier 5',
                'phone' => '098123123123'
            ],                        
        ];

        Supplier::insert($suppliers);
    }
}
