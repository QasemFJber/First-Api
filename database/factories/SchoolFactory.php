<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\School>
 */
class SchoolFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
        'name' =>fake()->company,
        'address' =>fake()->address,
        'phone_number' =>fake()->phoneNumber,
        'email' =>fake()->email,
        ];
    }
}
