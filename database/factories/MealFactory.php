<?php

namespace Database\Factories;

use App\Models\Ingredient;
use App\Models\Meal;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sourceDirectory = storage_path('app/seed_images');
        $destinationDirectory = 'meal-images';

        Storage::disk('public')->makeDirectory($destinationDirectory);

        $sourceFiles = File::files($sourceDirectory);

        $imagePath = null;
        if (count($sourceFiles) > 0) {
            $randomFile = $sourceFiles[array_rand($sourceFiles)];
            $newFilename = uniqid() . '-' . $randomFile->getFilename();

            Storage::disk('public')->put(
                $destinationDirectory . '/' . $newFilename,
                File::get($randomFile)
            );

            $imagePath = $destinationDirectory . '/' . $newFilename;
        }

        return [
            'name' => str()->title(fake()->words(rand(2, 4), true)),
            'user_id' => \App\Models\User::factory(),
            'image_path' => $imagePath,

            'created_at' => fake()->dateTimeBetween('-1 month', 'now'),
            'updated_at' => function (array $attributes) {
                return $attributes['created_at'];
            },
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Meal $meal) {
            $ingredientCount = rand(3, 8);
            $ingredients = Ingredient::inRandomOrder()->take($ingredientCount)->get();
            $gramUnitId = Unit::where('abbreviation', 'g')->first()->id ?? 1;

            foreach ($ingredients as $ingredient) {
                $meal->ingredients()->attach($ingredient->id, [
                    'quantity' => rand(50, 300),
                    'unit_id' => $gramUnitId,
                ]);
            }
        });
    }
}
