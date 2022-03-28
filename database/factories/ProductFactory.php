<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'category_id' => \App\Models\Category::inRandomORder()->first(),
            'description' => $this->faker->paragraph,
            'price' => rand(1000,99999),
        ];
    }
}
