<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Meal;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Goal;
use App\Models\Friendship;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {

        $this->call([
            UnitSeeder::class,
            IngredientSeeder::class,
        ]);

        $mainUser = User::factory()->has(Goal::factory())->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $otherUsers = User::factory(15)
            ->has(Goal::factory())
            ->create();

        $allUsers = $otherUsers->merge([$mainUser]);

        $allUsers->each(function ($user) {
            Meal::factory(rand(2, 10))->create([
                'user_id' => $user->id,
            ]);
        });

        $allUsers->each(function (User $user) use ($allUsers) {

            $friendsToAddCount = rand(1, 9);

            $potentialFriends = $allUsers->except($user->id);

            $friendsToAddCount = min($friendsToAddCount, $potentialFriends->count());

            $friendsToBefriend = $potentialFriends->random($friendsToAddCount);

            foreach ($friendsToBefriend as $friend) {

                if (!$user->getFriendship($friend)) {
                    Friendship::create([
                        'requester_id' => $user->id,
                        'addressee_id' => $friend->id,
                        'status' => 1, // 1 = Accepted
                    ]);
                }
            }
        });
    }

}
