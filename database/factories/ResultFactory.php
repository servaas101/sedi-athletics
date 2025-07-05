<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Result>
 */
class ResultFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'event_id' => \App\Models\Event::factory(),
            'athlete_id' => \App\Models\Athlete::factory(),
            'rank' => $this->faker->numberBetween(1, 10),
            'time' => $this->faker->time,
            'points' => $this->faker->numberBetween(1, 100),
            'recorded_at' => $this->faker->dateTimeThisYear,
        ];
    }
}
