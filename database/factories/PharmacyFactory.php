<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pharmacy>
 */
class PharmacyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'area_id' => fake()->numberBetween($min = 1, $max = 5),
            'owner_user_id' => fake()->numberBetween($min = 1, $max = 21),
            'priority' => fake()->unique()->numberBetween($min = 1, $max = 5),
        ];
    }
}
