<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $units = Unit::all()->keyBy('id');
        $goal = $user->goal;


        $endDate = today();
        $startDate = today()->subDays(30);
        $dateRange = Carbon::parse($startDate)->toPeriod($endDate);


        $weekStartDate = today()->subDays(6);
        $weekDateRange = Carbon::parse($weekStartDate)->toPeriod($endDate);

        $meals = $user->meals()
            ->whereBetween('created_at', [$startDate, $endDate->copy()->endOfDay()])
            ->with('ingredients')
            ->get();

        $weeklyMeals = $user->meals()
            ->whereBetween('created_at', [$weekStartDate, $endDate->copy()->endOfDay()])
            ->with('ingredients')
            ->get();

        $mealsByDay = $meals->groupBy(function ($meal) {
            return $meal->created_at->format('Y-m-d');
        });

        $weeklyMealsByDay = $weeklyMeals->groupBy(function ($meal) {
            return $meal->created_at->format('Y-m-d');
        });


        $chartLabels = [];
        $chartData = [];
        $monthlyNutritionData = [];

        foreach ($dateRange as $date) {
            $dateString = $date->format('Y-m-d');
            $dayName = $date->format('M j');
            $chartLabels[] = $dayName;

            $dayNutrition = $this->calculateDayNutrition($mealsByDay[$dateString] ?? collect(), $units);
            $chartData[] = $dayNutrition['calories'];
            $monthlyNutritionData[$dateString] = $dayNutrition;
        }


        $weeklyLabels = [];
        $weeklyData = [];
        $weeklyNutritionData = [];
        $weeklyProteinData = [];
        $weeklyCarbsData = [];
        $weeklyFatData = [];

        foreach ($weekDateRange as $date) {
            $dateString = $date->format('Y-m-d');
            $dayName = $date->format('D');
            $weeklyLabels[] = $dayName;

            $dayNutrition = $this->calculateDayNutrition($weeklyMealsByDay[$dateString] ?? collect(), $units);
            $weeklyData[] = $dayNutrition['calories'];
            $weeklyProteinData[] = $dayNutrition['protein'];
            $weeklyCarbsData[] = $dayNutrition['carbs'];
            $weeklyFatData[] = $dayNutrition['fat'];
            $weeklyNutritionData[$dateString] = $dayNutrition;
        }


        $totalMeals = $meals->count();
        $weeklyMealsCount = $weeklyMeals->count();
        $avgDailyCalories = count($weeklyData) > 0 ? array_sum($weeklyData) / count($weeklyData) : 0;
        $maxCalories = count($weeklyData) > 0 ? max($weeklyData) : 0;
        $maxCaloriesDay = $maxCalories > 0 ? $weeklyLabels[array_search($maxCalories, $weeklyData)] : '';
        $weeklyTotal = array_sum($weeklyData);


        $dailyGoal = $goal->daily_calories ?? 2000;
        $daysOnTarget = 0;
        $daysOverTarget = 0;
        $daysUnderTarget = 0;

        foreach ($weeklyData as $calories) {
            if ($calories >= ($dailyGoal * 0.8) && $calories <= $dailyGoal) {
                $daysOnTarget++;
            } elseif ($calories > $dailyGoal) {
                $daysOverTarget++;
            } else {
                $daysUnderTarget++;
            }
        }


        $avgProtein = count($weeklyProteinData) > 0 ? array_sum($weeklyProteinData) / count($weeklyProteinData) : 0;
        $avgCarbs = count($weeklyCarbsData) > 0 ? array_sum($weeklyCarbsData) / count($weeklyCarbsData) : 0;
        $avgFat = count($weeklyFatData) > 0 ? array_sum($weeklyFatData) / count($weeklyFatData) : 0;


        $totalMacros = $avgProtein + $avgCarbs + $avgFat;
        $macroPercentages = [
            'protein' => $totalMacros > 0 ? round(($avgProtein * 4 / ($avgDailyCalories > 0 ? $avgDailyCalories : 1)) * 100) : 0,
            'carbs' => $totalMacros > 0 ? round(($avgCarbs * 4 / ($avgDailyCalories > 0 ? $avgDailyCalories : 1)) * 100) : 0,
            'fat' => $totalMacros > 0 ? round(($avgFat * 9 / ($avgDailyCalories > 0 ? $avgDailyCalories : 1)) * 100) : 0,
        ];


        $totalPercentage = array_sum($macroPercentages);
        if ($totalPercentage > 0 && $totalPercentage != 100) {
            $macroPercentages['carbs'] = 100 - $macroPercentages['protein'] - $macroPercentages['fat'];
        }

        return view('reports.index', [
            'chartLabels' => $weeklyLabels,
            'chartData' => $weeklyData,
            'weeklyProteinData' => $weeklyProteinData,
            'weeklyCarbsData' => $weeklyCarbsData,
            'weeklyFatData' => $weeklyFatData,
            'weeklyNutritionData' => $weeklyNutritionData,
            'goal' => $goal,
            'totalMeals' => $totalMeals,
            'weeklyMealsCount' => $weeklyMealsCount,
            'avgDailyCalories' => round($avgDailyCalories),
            'maxCalories' => $maxCalories,
            'maxCaloriesDay' => $maxCaloriesDay,
            'weeklyTotal' => $weeklyTotal,
            'daysOnTarget' => $daysOnTarget,
            'daysOverTarget' => $daysOverTarget,
            'daysUnderTarget' => $daysUnderTarget,
            'avgProtein' => round($avgProtein),
            'avgCarbs' => round($avgCarbs),
            'avgFat' => round($avgFat),
            'macroPercentages' => $macroPercentages,
            'units' => $units
        ]);
    }

    private function calculateDayNutrition($meals, $units)
    {
        $nutrition = [
            'calories' => 0,
            'protein' => 0,
            'carbs' => 0,
            'fat' => 0
        ];

        foreach ($meals as $meal) {
            foreach ($meal->ingredients as $ingredient) {
                $quantity = $ingredient->pivot->quantity;
                $unitId = $ingredient->pivot->unit_id;
                $conversionFactor = $units[$unitId]->conversion_factor ?? 1.0;
                $quantityInGrams = $quantity * $conversionFactor;

                $nutrition['calories'] += ($ingredient->calories_per_100g / 100) * $quantityInGrams;
                $nutrition['protein'] += ($ingredient->protein_per_100g / 100) * $quantityInGrams;
                $nutrition['carbs'] += ($ingredient->carbs_per_100g / 100) * $quantityInGrams;
                $nutrition['fat'] += ($ingredient->fat_per_100g / 100) * $quantityInGrams;
            }
        }

        return [
            'calories' => round($nutrition['calories']),
            'protein' => round($nutrition['protein']),
            'carbs' => round($nutrition['carbs']),
            'fat' => round($nutrition['fat'])
        ];
    }
}
