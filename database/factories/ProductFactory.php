<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => rand(1, 10),
            'name_product' => fake()->text(30),
            'description' => fake()->text(1000),
            'avatar' => fake()->imageUrl(),
            'price' => rand(100, 999),
            'new_price' => rand(100, 999),
        ];
    }
}
