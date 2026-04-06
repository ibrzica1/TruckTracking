<?php

namespace Database\Factories;

use App\Models\Shipments;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Shipments>
 */
class ShipmentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),

            'from_city' => $this->faker->city,
            'from_country' => $this->faker->country,

            'to_city' => $this->faker->city,
            'to_country' => $this->faker->country,

            'price' => $this->faker->numberBetween(200,5000),

            'status' => $this->faker->randomElement([
                'in_progress',
                'unnasigned',
                'completed',
                'problem'
            ]),

            'user_id' => User::factory(),

            'details' => $this->faker->paragraph(),
        ];
    }
}
