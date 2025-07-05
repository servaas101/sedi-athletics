<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Discipline>
 */
class DisciplineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'competition_id' => \App\Models\Competition::factory(),
            'gender' => $this->faker->randomElement(['male', 'female', 'mixed']),
            'category' => $this->faker->word,
            'distance' => $this->faker->numberBetween(50, 10000) . 'm',
            'round' => $this->faker->randomElement(['heat', 'semi-final', 'final']),
            'heat_number' => $this->faker->numberBetween(1, 5),
            'scheduled_time' => $this->faker->time,
        ];
    }
}
