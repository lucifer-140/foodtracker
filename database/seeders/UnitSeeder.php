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
        $units = [
            ['name' => 'gram', 'abbreviation' => 'g'],
            ['name' => 'kilogram', 'abbreviation' => 'kg'],
            ['name' => 'milliliter', 'abbreviation' => 'ml'],
            ['name' => 'liter', 'abbreviation' => 'l'],
            ['name' => 'ounce', 'abbreviation' => 'oz'],
            ['name' => 'pound', 'abbreviation' => 'lb'],
            ['name' => 'piece', 'abbreviation' => 'pc'],
            ['name' => 'teaspoon', 'abbreviation' => 'tsp'],
            ['name' => 'tablespoon', 'abbreviation' => 'tbsp'],
        ];

        foreach ($units as $unit) {
            Unit::create($unit);
        }
    }
}
