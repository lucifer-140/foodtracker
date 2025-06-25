<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Http\Request;
use App\Models\Unit;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FeedController extends Controller
{

    use AuthorizesRequests;

    public function index()
    {
        $user = auth()->user();
        $friendIds = $user->friends->pluck('id');

        $meals = Meal::whereIn('user_id', $friendIds)
            ->with('user', 'ingredients')
            ->latest()
            ->paginate(10);

        $units = Unit::all()->keyBy('id');

        $meals->each(function ($meal) use ($units) {
            $totals = ['calories' => 0, 'protein' => 0, 'fat' => 0, 'carbs' => 0];
            foreach ($meal->ingredients as $ingredient) {
                $quantity = $ingredient->pivot->quantity;
                $unitId = $ingredient->pivot->unit_id;
                $conversionFactor = $units[$unitId]->conversion_factor ?? 1.0;
                $quantityInGrams = $quantity * $conversionFactor;

                $totals['calories'] += ($ingredient->calories_per_100g / 100) * $quantityInGrams;
                $totals['protein']  += ($ingredient->protein_per_100g / 100) * $quantityInGrams;
                $totals['fat']      += ($ingredient->fat_per_100g / 100) * $quantityInGrams;
                $totals['carbs']    += ($ingredient->carbs_per_100g / 100) * $quantityInGrams;
            }

            $meal->total_calories = $totals['calories'];
            $meal->total_protein  = $totals['protein'];
            $meal->total_fat      = $totals['fat'];
            $meal->total_carbs    = $totals['carbs'];
        });

        return view('feed.index', [
            'meals' => $meals,
        ]);
    }

    public function showFriendMeal(Meal $meal)
    {
        $this->authorize('view', $meal);

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

        return view('feed.show-meal', [
            'meal' => $meal,
            'total' => $total,
            'units' => $units,
        ]);
    }
}
