<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medicine>
 */
class MedicineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $medicine_types = ["Tablet", "Syrup", "Cream", "Suppository", "Ampol"];

        return [
            'name' => fake()->name(),
            'type' => $medicine_types[array_rand($medicine_types)],
            'price' => fake()->numberBetween(10, 500),
        ];
    }
}
