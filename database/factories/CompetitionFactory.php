<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Competition>
 */
class CompetitionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'school_id' => \App\Models\Tenant::factory(),
            'code' => $this->faker->unique()->word . $this->faker->randomNumber(3),
            'name' => $this->faker->sentence(3),
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
            'location' => $this->faker->city,
            'description' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['scheduled', 'completed', 'cancelled']),
        ];
    }
}
