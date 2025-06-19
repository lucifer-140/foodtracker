<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Unit;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Note: Some units like 'piece', 'tsp', etc., are tricky as their weight
        // depends on the ingredient. For now, we'll treat them as grams (a factor of 1)
        // as a simplification. A more advanced system could handle this differently.
        $units = [
            // Metric Weight
            ['name' => 'gram', 'abbreviation' => 'g', 'conversion_factor' => 1.0],
            ['name' => 'kilogram', 'abbreviation' => 'kg', 'conversion_factor' => 1000.0],

            // Imperial Weight
            ['name' => 'pound', 'abbreviation' => 'lb', 'conversion_factor' => 453.592],
            ['name' => 'ounce', 'abbreviation' => 'oz', 'conversion_factor' => 28.3495],

            // Volume (Approximated to grams of water)
            ['name' => 'milliliter', 'abbreviation' => 'ml', 'conversion_factor' => 1.0],
            ['name' => 'liter', 'abbreviation' => 'l', 'conversion_factor' => 1000.0],
            ['name' => 'teaspoon', 'abbreviation' => 'tsp', 'conversion_factor' => 5.0],
            ['name' => 'tablespoon', 'abbreviation' => 'tbsp', 'conversion_factor' => 15.0],

            // Piece-based
            ['name' => 'piece', 'abbreviation' => 'pc', 'conversion_factor' => 1.0],
        ];

        foreach ($units as $unitData) {
            \App\Models\Unit::updateOrCreate(
                ['name' => $unitData['name']],
                $unitData
            );
        }
    }
}
