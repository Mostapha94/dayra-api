<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => $faker->word,
            "description " => $faker->paragraph,
            "price" => $faker->numberBetween(100,1000),
            "discount" => $faker->numberBetween(2,30),
            "supplier_id" => function(){
                return Supplier::all()->random();
            },
            "category_id" => function(){
                return Category::all()->random();
            },
            "units" => $faker->randomDigit,
        ];
    }
}
