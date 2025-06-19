<?php

namespace Database\Factories;

use App\Models\Ingredient;
use App\Models\Meal;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

class MealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Generate a random, capitalized, 2-to-4-word meal name
            'name' => str()->title(fake()->words(rand(2, 4), true)),
            'user_id' => \App\Models\User::factory(),
            'image_path' => null,
        ];
    }

    /**
     * Configure the model factory.
     * This is where we attach ingredients after a meal has been created.
     */
    public function configure(): static
    {
        return $this->afterCreating(function (Meal $meal) {

            $ingredientCount = rand(3, 8);
            $ingredients = Ingredient::inRandomOrder()->take($ingredientCount)->get();
            $gramUnitId = Unit::where('abbreviation', 'g')->first()->id;

            foreach ($ingredients as $ingredient) {
                $meal->ingredients()->attach($ingredient->id, [
                    'quantity' => rand(50, 300),
                    'unit_id' => $gramUnitId,
                ]);
            }
        });
    }
}
