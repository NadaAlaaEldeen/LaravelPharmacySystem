<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'street_name' => fake()->streetName(),
            'building_number' => fake()->randomDigit(),
            'floor_number' => fake()->randomDigit(),
            'flat_number' => fake()->randomDigit(),
            'is_main' => fake()->boolean(),
            'user_id' => fake()->numberBetween($min = 1, $max = 10),
            'area_id' => fake()->numberBetween($min = 1, $max = 5),
        ];
    }
}
