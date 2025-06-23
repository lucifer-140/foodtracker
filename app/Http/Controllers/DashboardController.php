<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;

class DashboardController extends Controller
{
    /**
     * Display the user's dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = auth()->user();


        $recentMeals = $user->meals()->latest()->take(3)->get();
        $goal = $user->goal;

        $todaysMeals = $user->meals()
            ->whereDate('created_at', today())
            ->with('ingredients') // Eager load for efficiency
            ->get();


        $todaysTotals = ['calories' => 0, 'protein' => 0, 'fat' => 0, 'carbs' => 0];
        $units = Unit::all()->keyBy('id');

        foreach ($todaysMeals as $meal) {
            foreach ($meal->ingredients as $ingredient) {
                $quantity = $ingredient->pivot->quantity;
                $unitId = $ingredient->pivot->unit_id;
                $conversionFactor = $units[$unitId]->conversion_factor ?? 1.0;
                $quantityInGrams = $quantity * $conversionFactor;

                $todaysTotals['calories'] += ($ingredient->calories_per_100g / 100) * $quantityInGrams;
                $todaysTotals['protein']  += ($ingredient->protein_per_100g / 100) * $quantityInGrams;
                $todaysTotals['fat']      += ($ingredient->fat_per_100g / 100) * $quantityInGrams;
                $todaysTotals['carbs']    += ($ingredient->carbs_per_100g / 100) * $quantityInGrams;
            }
        }


        $allMeals = $user->meals()->latest()->get();

        return view('dashboard', [
            'meals' => $allMeals,
            'recentMeals' => $recentMeals,
            'goal' => $goal,
            'todaysTotals' => $todaysTotals,
        ]);
    }
}
