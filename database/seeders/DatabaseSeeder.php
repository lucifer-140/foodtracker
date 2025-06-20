<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Meal;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        $this->call([
            UnitSeeder::class,
            IngredientSeeder::class,
        ]);


        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        User::factory(15)->create()->each(function ($user) {
            Meal::factory(rand(2, 10))->create([
                'user_id' => $user->id,
            ]);
        });


    }
}
