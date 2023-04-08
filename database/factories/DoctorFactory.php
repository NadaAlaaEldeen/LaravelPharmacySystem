<?php

namespace Database\Factories;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {


            return [

                'pharmacy_id' => fake()->numberBetween($min = 2, $max = 5),
                'user_id' => fake()->numberBetween($min = 2, $max = 10),
                'is_ban' => fake()->boolean
            ];

    }

}
