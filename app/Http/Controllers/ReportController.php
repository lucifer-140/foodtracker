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


        $endDate = today();
        $startDate = today()->subDays(30);
        $dateRange = Carbon::parse($startDate)->toPeriod($endDate);


        $meals = $user->meals()
            ->whereBetween('created_at', [$startDate, $endDate->copy()->endOfDay()])
            ->with('ingredients')
            ->get();


        $mealsByDay = $meals->groupBy(function ($meal) {
            return $meal->created_at->format('Y-m-d');
        });


        $chartLabels = [];
        $chartData = [];

        foreach ($dateRange as $date) {
            $dateString = $date->format('Y-m-d');
            $dayName = $date->format('M j'); // e.g., "Jun 21"
            $chartLabels[] = $dayName;

            $totalCaloriesForDay = 0;
            if (isset($mealsByDay[$dateString])) {

                foreach ($mealsByDay[$dateString] as $meal) {
                    foreach ($meal->ingredients as $ingredient) {
                        $quantity = $ingredient->pivot->quantity;
                        $unitId = $ingredient->pivot->unit_id;
                        $conversionFactor = $units[$unitId]->conversion_factor ?? 1.0;
                        $quantityInGrams = $quantity * $conversionFactor;
                        $totalCaloriesForDay += ($ingredient->calories_per_100g / 100) * $quantityInGrams;
                    }
                }
            }
            $chartData[] = round($totalCaloriesForDay);
        }

        return view('reports.index', [
            'chartLabels' => $chartLabels,
            'chartData' => $chartData,
            'goal' => auth()->user()->goal
        ]);
    }
}
