<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Directorate>
 */
class DirectorateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' =>fake()->unique()->company,
            'type' =>fake()->randomElement(['public', 'private', 'religious']),
            'educational_district' =>fake()->state,
            'address' =>fake()->address,
            'phone_number' =>fake()->phoneNumber,
            'email' =>fake()->email,
            'educational_director_name' =>fake()->name,
            'educational_director_phone_number' =>fake()->phoneNumber,
            'students_number' =>fake()->numberBetween(100, 2000),
            'teachers_number' =>fake()->numberBetween(10, 100),
            'departments' =>fake()->paragraphs(3, true),
        ];
    }
}
