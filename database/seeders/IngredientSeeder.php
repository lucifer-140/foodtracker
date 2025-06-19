<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ingredient;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // A more comprehensive list of common ingredients
        $ingredients = [
            // Poultry & Meats
            ['name' => 'Chicken Breast', 'calories_per_100g' => 165, 'protein_per_100g' => 31, 'fat_per_100g' => 4, 'carbs_per_100g' => 0],
            ['name' => 'Chicken Thigh', 'calories_per_100g' => 209, 'protein_per_100g' => 26, 'fat_per_100g' => 11, 'carbs_per_100g' => 0],
            ['name' => 'Ground Beef (90/10)', 'calories_per_100g' => 200, 'protein_per_100g' => 20, 'fat_per_100g' => 13, 'carbs_per_100g' => 0],
            ['name' => 'Bacon', 'calories_per_100g' => 541, 'protein_per_100g' => 37, 'fat_per_100g' => 42, 'carbs_per_100g' => 1],
            ['name' => 'Pork Chop', 'calories_per_100g' => 231, 'protein_per_100g' => 26, 'fat_per_100g' => 13, 'carbs_per_100g' => 0],

            // Fish & Seafood
            ['name' => 'Salmon Fillet', 'calories_per_100g' => 208, 'protein_per_100g' => 20, 'fat_per_100g' => 13, 'carbs_per_100g' => 0],
            ['name' => 'Tuna (canned in water)', 'calories_per_100g' => 86, 'protein_per_100g' => 19, 'fat_per_100g' => 1, 'carbs_per_100g' => 0],
            ['name' => 'Shrimp', 'calories_per_100g' => 85, 'protein_per_100g' => 20, 'fat_per_100g' => 0, 'carbs_per_100g' => 0],

            // Grains & Carbs
            ['name' => 'White Rice', 'calories_per_100g' => 130, 'protein_per_100g' => 3, 'fat_per_100g' => 0, 'carbs_per_100g' => 28],
            ['name' => 'Brown Rice', 'calories_per_100g' => 111, 'protein_per_100g' => 3, 'fat_per_100g' => 1, 'carbs_per_100g' => 23],
            ['name' => 'Quinoa', 'calories_per_100g' => 120, 'protein_per_100g' => 4, 'fat_per_100g' => 2, 'carbs_per_100g' => 21],
            ['name' => 'Pasta (Dry)', 'calories_per_100g' => 371, 'protein_per_100g' => 13, 'fat_per_100g' => 2, 'carbs_per_100g' => 75],
            ['name' => 'Whole Wheat Bread', 'calories_per_100g' => 247, 'protein_per_100g' => 13, 'fat_per_100g' => 4, 'carbs_per_100g' => 41],
            ['name' => 'Potato', 'calories_per_100g' => 77, 'protein_per_100g' => 2, 'fat_per_100g' => 0, 'carbs_per_100g' => 17],
            ['name' => 'Sweet Potato', 'calories_per_100g' => 86, 'protein_per_100g' => 2, 'fat_per_100g' => 0, 'carbs_per_100g' => 20],

            // Vegetables
            ['name' => 'Broccoli', 'calories_per_100g' => 34, 'protein_per_100g' => 3, 'fat_per_100g' => 0, 'carbs_per_100g' => 7],
            ['name' => 'Spinach', 'calories_per_100g' => 23, 'protein_per_100g' => 3, 'fat_per_100g' => 0, 'carbs_per_100g' => 4],
            ['name' => 'Carrot', 'calories_per_100g' => 41, 'protein_per_100g' => 1, 'fat_per_100g' => 0, 'carbs_per_100g' => 10],
            ['name' => 'Bell Pepper', 'calories_per_100g' => 20, 'protein_per_100g' => 1, 'fat_per_100g' => 0, 'carbs_per_100g' => 5],
            ['name' => 'Onion', 'calories_per_100g' => 40, 'protein_per_100g' => 1, 'fat_per_100g' => 0, 'carbs_per_100g' => 9],
            ['name' => 'Tomato', 'calories_per_100g' => 18, 'protein_per_100g' => 1, 'fat_per_100g' => 0, 'carbs_per_100g' => 4],
            ['name' => 'Avocado', 'calories_per_100g' => 160, 'protein_per_100g' => 2, 'fat_per_100g' => 15, 'carbs_per_100g' => 9],
            ['name' => 'Cucumber', 'calories_per_100g' => 15, 'protein_per_100g' => 1, 'fat_per_100g' => 0, 'carbs_per_100g' => 4],


            // Dairy & Eggs
            ['name' => 'Large Egg', 'calories_per_100g' => 155, 'protein_per_100g' => 13, 'fat_per_100g' => 11, 'carbs_per_100g' => 1],
            ['name' => 'Milk (Whole)', 'calories_per_100g' => 61, 'protein_per_100g' => 3, 'fat_per_100g' => 3, 'carbs_per_100g' => 5],
            ['name' => 'Cheddar Cheese', 'calories_per_100g' => 404, 'protein_per_100g' => 25, 'fat_per_100g' => 33, 'carbs_per_100g' => 1],
            ['name' => 'Greek Yogurt', 'calories_per_100g' => 59, 'protein_per_100g' => 10, 'fat_per_100g' => 0, 'carbs_per_100g' => 4],

            // Fats & Oils
            ['name' => 'Olive Oil', 'calories_per_100g' => 884, 'protein_per_100g' => 0, 'fat_per_100g' => 100, 'carbs_per_100g' => 0],
            ['name' => 'Butter', 'calories_per_100g' => 717, 'protein_per_100g' => 1, 'fat_per_100g' => 81, 'carbs_per_100g' => 0],

            // Nuts & Seeds
            ['name' => 'Almonds', 'calories_per_100g' => 579, 'protein_per_100g' => 21, 'fat_per_100g' => 49, 'carbs_per_100g' => 22],
        ];

        foreach ($ingredients as $ingredientData) {
            Ingredient::updateOrCreate(
                ['name' => $ingredientData['name']],
                $ingredientData
            );
        }
    }
}
