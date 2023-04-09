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
    public function definition()
    {
        return [
        'name' =>fake()->word(),
        'price' =>fake()->randomFloat(2, 10, 500),
        'description' =>fake()->sentence(),
        'quantity' =>fake()->numberBetween(1, 100),
        'image' =>fake()->imageUrl(),
        ];
    }
}
