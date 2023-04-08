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

<<<<<<< HEAD

            return [

                'pharmacy_id' => fake()->numberBetween($min = 2, $max = 5),
                'user_id' => fake()->numberBetween($min = 2, $max = 10),
                'is_ban' => fake()->boolean
=======
            return [
                'pharmacy_id' => fake()->numberBetween($min = 2, $max = 5),
                'user_id' => fake()->numberBetween($min = 2, $max = 10),
                'is_ban' => fake()->boolean,
>>>>>>> 755bfebc975a47121791728c7f7358b4efd95707
            ];

    }

}
