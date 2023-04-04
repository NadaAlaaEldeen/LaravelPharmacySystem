<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween($min = 1, $max = 10),
            'doctor_id' => fake()->numberBetween($min = 1, $max = 5),
            'pharmacy_id' => fake()->numberBetween($min = 1, $max = 5),
            'address_id' => fake()->numberBetween(1, 5),
            'is_insured'=>fake()->boolean(),
            'status'=>'new',
            'total_price'=>fake()->numberBetween(10, 500),
        ];
    }
}
