<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => "Lorem ipsum 1",
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua consequat.',
                'units' => 21,
                'price' => 200.10,
                'discount' => 30,
                'supplier_id' => 1,
                'category_id' => 1,
                'image' => 'default.jpg',
                
            ],
            [
                'name' => "Lorem ipsum 2",
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua consequat.',
                'units' => 400,
                'price' => 1600.21,
                'discount' => 30,
                'supplier_id' => 1,
                'category_id' => 1,
                'image' => 'default.jpg',
                
            ],
            [
                'name' => "Lorem ipsum 3",
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua consequat.',
                'units' => 37,
                'price' => 378.00,
                'discount' => 30,
                'supplier_id' => 1,
                'category_id' => 1,
                'image' => 'default.jpg',
                
            ],
            [
                'name' => "Lorem ipsum 4",
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua consequat.',
                'units' => 10,
                'price' => 21.10,
                'discount' => 30,
                'supplier_id' => 1,
                'category_id' => 1,
                'image' => 'default.jpg',
                
            ]
        ];

        DB::table('products')->insert($products);

    }
}
