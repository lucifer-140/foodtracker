<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Meal;
use App\Models\Goal;
use App\Models\Friendship;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Run the essential seeders first.
        $this->call([
            UnitSeeder::class,
            IngredientSeeder::class,
        ]);

        // 2. Create users.
        $mainUser = User::factory()->has(Goal::factory())->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $otherUsers = User::factory(15)
            ->has(Goal::factory())
            ->create();
        $allUsers = $otherUsers->push($mainUser);

        // 3. Create random meals for the OTHER users.
        $otherUsers->each(function ($user) {
            Meal::factory(rand(5, 15))->create([
                'user_id' => $user->id,
            ]);
        });

        // 4. Create structured, daily meals for the main user for the current week.
        $this->command->info('Creating structured weekly meals for the main test user...');
        $startOfWeek = now()->startOfWeek();
        $today = today();
        $datePeriod = Carbon::create($startOfWeek)->toPeriod($today);

        foreach ($datePeriod as $date) {
            $mealCountForDay = rand(2, 4);
            for ($i = 0; $i < $mealCountForDay; $i++) {
                // --- THIS IS THE FIX ---
                // Create a new timestamp with a random time on the current day in the loop.
                $randomTimestamp = $date->copy()->addHours(rand(8, 22))->addMinutes(rand(0, 59));

                Meal::factory()->create([
                    'user_id' => $mainUser->id,
                    'created_at' => $randomTimestamp,
                    'updated_at' => $randomTimestamp,
                ]);
            }
        }

        // 5. Create a friendship network.
        $allUsers->each(function (User $user) use ($allUsers) {
            $friendsToAddCount = rand(1, 2);
            $potentialFriends = $allUsers->except($user->id);
            if ($potentialFriends->isEmpty()) return; // Skip if no other users exist
            $friendsToAddCount = min($friendsToAddCount, $potentialFriends->count());

            $friendsToBefriend = $potentialFriends->random($friendsToAddCount);

            foreach ($friendsToBefriend as $friend) {
                if (!$user->getFriendship($friend)) {
                    Friendship::create([
                        'requester_id' => $user->id,
                        'addressee_id' => $friend->id,
                        'status' => 1,
                    ]);
                }
            }
        });
    }
}
