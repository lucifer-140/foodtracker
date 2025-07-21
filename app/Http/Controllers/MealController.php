<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\Meal;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MealController extends Controller
{
    use AuthorizesRequests;

    public function create()
    {
        $ingredients = Ingredient::orderBy('name')->get();
        $units = Unit::all();
        $unitsJson = $units->keyBy('id');
        $ingredientsJson = $ingredients->keyBy('id');

        return view('meals.create', [
            'ingredients' => $ingredients,
            'units' => $units,
            'ingredientsJson' => $ingredientsJson,
            'unitsJson' => $unitsJson,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ingredients' => 'required|array|min:1',
            'ingredients.*.id' => 'required|exists:ingredients,id',
            'ingredients.*.quantity' => 'required|numeric|min:0.1',
            'ingredients.*.unit_id' => 'required|exists:units,id',
        ]);

        DB::transaction(function () use ($request, $validated) {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('meal-images', 'public');
            }

            $meal = auth()->user()->meals()->create([
                'name' => $validated['name'],
                'image_path' => $imagePath,
            ]);

            foreach ($validated['ingredients'] as $ingredientData) {
                $meal->ingredients()->attach($ingredientData['id'], [
                    'quantity' => $ingredientData['quantity'],
                    'unit_id' => $ingredientData['unit_id'],
                ]);
            }
        });

        return redirect()->route('dashboard')->with('success', 'Meal created successfully!');
    }

    public function show(Meal $meal)
    {
        $this->authorize('view', $meal);
        $meal->load('ingredients');
        $units = Unit::all()->keyBy('id');
        $total = ['calories' => 0, 'protein' => 0, 'fat' => 0, 'carbs' => 0];
        $goal = auth()->user()->goal;

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

        return view('meals.show', [
            'meal' => $meal,
            'total' => $total,
            'units' => $units,
            'goal' => $goal,
        ]);
    }

    public function edit(Meal $meal)
    {
        $this->authorize('update', $meal);
        $meal->load('ingredients');
        $ingredients = Ingredient::orderBy('name')->get();
        $ingredientsJson = $ingredients->keyBy('id');
        $units = Unit::all();
        $unitsJson = $units->keyBy('id');
        $total = ['calories' => 0, 'protein' => 0, 'fat' => 0, 'carbs' => 0];

        foreach ($meal->ingredients as $ingredient) {
            $quantity = $ingredient->pivot->quantity;
            $unitId = $ingredient->pivot->unit_id;
            $conversionFactor = $unitsJson[$unitId]->conversion_factor ?? 1.0;
            $quantityInGrams = $quantity * $conversionFactor;

            $total['calories'] += ($ingredient->calories_per_100g / 100) * $quantityInGrams;
            $total['protein']  += ($ingredient->protein_per_100g / 100) * $quantityInGrams;
            $total['fat']      += ($ingredient->fat_per_100g / 100) * $quantityInGrams;
            $total['carbs']    += ($ingredient->carbs_per_100g / 100) * $quantityInGrams;
        }

        return view('meals.edit', [
            'meal' => $meal,
            'ingredients' => $ingredients,
            'units' => $units,
            'ingredientsJson' => $ingredientsJson,
            'unitsJson' => $unitsJson,
            'total' => $total,
        ]);
    }

    public function update(Request $request, Meal $meal)
    {
        $this->authorize('update', $meal);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ingredients' => 'required|array|min:1',
            'ingredients.*.id' => 'required|exists:ingredients,id',
            'ingredients.*.quantity' => 'required|numeric|min:0.1',
            'ingredients.*.unit_id' => 'required|exists:units,id',
        ], [
            'ingredients.min' => 'A meal must have at least one ingredient. Please add an ingredient or delete the meal.',
        ]);

        DB::transaction(function () use ($request, $meal, $validated) {
            $imagePath = $meal->image_path;
            if ($request->hasFile('image')) {
                if ($meal->image_path) {
                    Storage::disk('public')->delete($meal->image_path);
                }
                $imagePath = $request->file('image')->store('meal-images', 'public');
            }

            $meal->update(['name' => $validated['name'], 'image_path' => $imagePath]);

            $ingredientsToSync = [];
            foreach ($validated['ingredients'] as $ingredientData) {
                $ingredientsToSync[$ingredientData['id']] = [
                    'quantity' => $ingredientData['quantity'],
                    'unit_id' => $ingredientData['unit_id']
                ];
            }

            $meal->ingredients()->sync($ingredientsToSync);
        });

        return redirect()->route('meals.show', $meal)->with('success', 'Meal updated successfully!');
    }

    public function destroy(Meal $meal)
    {
        $this->authorize('delete', $meal);

        if ($meal->image_path) {
            Storage::disk('public')->delete($meal->image_path);
        }

        $meal->delete();

        return redirect()->route('dashboard')->with('success', 'Meal deleted successfully!');
    }

    public function archive(Request $request)
    {
        $units = Unit::all()->keyBy('id');
        $query = auth()->user()->meals()->with('ingredients');


        if ($request->filled('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }


        $sortBy = $request->get('sort_by', 'created_at_desc');

        switch ($sortBy) {
            case 'created_at_asc':
                $query->orderBy('created_at', 'asc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }


        if ($request->get('export') === 'csv') {
            return $this->exportToCsv($query->get(), $units);
        }

        $meals = $query->paginate(15)->appends($request->query());


        $meals->each(function ($meal) use ($units) {
            $total = [
                'calories' => 0,
                'protein' => 0,
                'fat' => 0,
                'carbs' => 0
            ];

            foreach ($meal->ingredients as $ingredient) {
                $quantity = $ingredient->pivot->quantity;
                $unitId = $ingredient->pivot->unit_id;
                $conversionFactor = $units[$unitId]->conversion_factor ?? 1.0;
                $quantityInGrams = $quantity * $conversionFactor;

                $total['calories'] += ($ingredient->calories_per_100g / 100) * $quantityInGrams;
                $total['protein'] += ($ingredient->protein_per_100g / 100) * $quantityInGrams;
                $total['fat'] += ($ingredient->fat_per_100g / 100) * $quantityInGrams;
                $total['carbs'] += ($ingredient->carbs_per_100g / 100) * $quantityInGrams;
            }

            $meal->calories = round($total['calories']);
            $meal->protein = round($total['protein']);
            $meal->fat = round($total['fat']);
            $meal->carbs = round($total['carbs']);
        });

        if ($request->filled('calorie_range')) {
            $range = $request->calorie_range;
            $filteredMeals = $meals->filter(function ($meal) use ($range) {
                switch ($range) {
                    case '0-200':
                        return $meal->calories >= 0 && $meal->calories <= 200;
                    case '200-400':
                        return $meal->calories > 200 && $meal->calories <= 400;
                    case '400-600':
                        return $meal->calories > 400 && $meal->calories <= 600;
                    case '600-800':
                        return $meal->calories > 600 && $meal->calories <= 800;
                    case '800+':
                        return $meal->calories > 800;
                    default:
                        return true;
                }
            });


            if ($range) {
                $currentPage = $request->get('page', 1);
                $perPage = 15;
                $offset = ($currentPage - 1) * $perPage;

                $paginatedItems = $filteredMeals->slice($offset, $perPage)->values();
                $meals = new \Illuminate\Pagination\LengthAwarePaginator(
                    $paginatedItems,
                    $filteredMeals->count(),
                    $perPage,
                    $currentPage,
                    [
                        'path' => $request->url(),
                        'pageName' => 'page',
                    ]
                );
                $meals->appends($request->query());
            }
        }

        return view('meals.archive', [
            'meals' => $meals,
        ]);
    }

    private function exportToCsv($meals, $units)
    {
        $filename = 'meals_export_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($meals, $units) {
            $file = fopen('php://output', 'w');


            fputcsv($file, [
                'Date',
                'Time',
                'Name',
                'Calories',
                'Protein (g)',
                'Carbs (g)',
                'Fat (g)',
                'Ingredients'
            ]);


            foreach ($meals as $meal) {

                $total = ['calories' => 0, 'protein' => 0, 'fat' => 0, 'carbs' => 0];
                $ingredientsList = [];

                foreach ($meal->ingredients as $ingredient) {
                    $quantity = $ingredient->pivot->quantity;
                    $unitId = $ingredient->pivot->unit_id;
                    $conversionFactor = $units[$unitId]->conversion_factor ?? 1.0;
                    $quantityInGrams = $quantity * $conversionFactor;

                    $total['calories'] += ($ingredient->calories_per_100g / 100) * $quantityInGrams;
                    $total['protein'] += ($ingredient->protein_per_100g / 100) * $quantityInGrams;
                    $total['fat'] += ($ingredient->fat_per_100g / 100) * $quantityInGrams;
                    $total['carbs'] += ($ingredient->carbs_per_100g / 100) * $quantityInGrams;

                    $unit = $units[$unitId];
                    $ingredientsList[] = $ingredient->name . ' (' . $quantity . ' ' . $unit->name . ')';
                }

                fputcsv($file, [
                    $meal->created_at->format('Y-m-d'),
                    $meal->created_at->format('H:i:s'),
                    $meal->name,
                    round($total['calories']),
                    round($total['protein']),
                    round($total['carbs']),
                    round($total['fat']),
                    implode(', ', $ingredientsList)
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
