<?php

namespace App\Http\Controllers;

use App\Models\Meal; // <-- Import Meal model
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FeedController extends Controller
{

    use AuthorizesRequests;
    /**
     * Display the user's social feed.
     */
    public function index()
    {

        // 1. Get the currently authenticated user
        $user = auth()->user();

        // 2. Get the IDs of all their friends
        $friendIds = $user->friends->pluck('id');

        // 3. Fetch all meals where the 'user_id' is in our list of friend IDs
        $meals = Meal::whereIn('user_id', $friendIds)
            ->with('user') // Eager load the 'user' relationship to get author details efficiently
            ->latest()     // Order by the newest meals first
            ->paginate(10); // Paginate the results

        // 4. Pass the meals to the view
        return view('feed.index', [
            'meals' => $meals,
        ]);
    }

    public function showFriendMeal(Meal $meal)
    {
        // Use our MealPolicy to authorize this action.
        // This will check if the user is friends with the meal's owner.
        $this->authorize('view', $meal);

        // --- The rest of the logic is for calculating totals ---
        $meal->load('ingredients');
        $units = \App\Models\Unit::all()->keyBy('id');
        $total = [
            'calories' => 0, 'protein' => 0, 'fat' => 0, 'carbs' => 0,
        ];

        foreach ($meal->ingredients as $ingredient) {
            $quantity = $ingredient->pivot->quantity;
            $unitId = $ingredient->pivot->unit_id;
            $conversionFactor = $units[$unitId]->conversion_factor ?? 1.0;
            $quantityInGrams = $quantity * $conversionFactor;

            $total['calories'] += ($ingredient->calories_per_100g / 100) * $quantityInGrams;
            $total['protein']  += ($ingredient->protein_per_100g / 100) * $quantityInGrams;
            $total['fat']      += ($ingredient->fat_per_100g / 100) * $quantityInGrams;
            $total['carbs']    += ($ingredient->carbs_per_100g / 100) * $quantityInGrams;
        }

        // Return a NEW view file
        return view('feed.show-meal', [
            'meal' => $meal,
            'total' => $total,
            'units' => $units,
        ]);
    }
}
