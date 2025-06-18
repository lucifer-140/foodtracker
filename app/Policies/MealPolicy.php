<?php

namespace App\Policies;

use App\Models\Meal;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MealPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Meal $meal): bool
    {
        // A user can view a meal if:
        // 1. It's their own meal.
        // 2. They are friends with the meal's owner.
        return $user->id === $meal->user_id || $user->friends->contains($meal->user);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Meal $meal): bool
    {
        // A user can only update their own meal.
        return $user->id === $meal->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Meal $meal): bool
    {
        // A user can only delete their own meal.
        return $user->id === $meal->user_id;
    }

    // Other policy methods like create, restore, forceDelete can be added here if needed.
}
