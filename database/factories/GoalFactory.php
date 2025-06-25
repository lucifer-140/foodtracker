<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GoalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'daily_calories' => round(fake()->numberBetween(1800, 3500) / 50) * 50,
            'daily_protein' => round(fake()->numberBetween(120, 250) / 5) * 5,
            'daily_fat' => round(fake()->numberBetween(60, 120) / 5) * 5,
            'daily_carbs' => round(fake()->numberBetween(150, 400) / 5) * 5,
        ];
    }
}
