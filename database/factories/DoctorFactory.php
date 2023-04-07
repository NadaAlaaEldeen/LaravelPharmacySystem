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

            $users = User::all();
            return [
                'area_id' => fake()->numberBetween($min = 2, $max = 5),
                'owner_user_id' => $this->faker->unique()->numberBetween(1, $users->count()),
                'priority' => fake()->unique()->numberBetween($min = 1, $max = 5),
                'name' => fake()->name()
            ];

    }

}
