<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\Meal;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MealController extends Controller
{

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
            'ingredients.*.quantity' => 'required|integer|min:1',
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
        // 1. Authorize that the user owns the meal
        if (auth()->user()->id !== $meal->user_id) {
            abort(403);
        }

        // 2. Eager load the ingredients relationship
        $meal->load('ingredients');

        // Fetch all unit data at once and key it by ID for efficient lookup
        $units = \App\Models\Unit::all()->keyBy('id');

        // 3. Initialize nutritional totals
        $total = [
            'calories' => 0,
            'protein' => 0,
            'fat' => 0,
            'carbs' => 0,
        ];

        // 4. Calculate totals WITH unit conversion
        foreach ($meal->ingredients as $ingredient) {
            // Get data from the pivot table
            $quantity = $ingredient->pivot->quantity;
            $unitId = $ingredient->pivot->unit_id;

            // Find the conversion factor for the selected unit
            $conversionFactor = 1.0; // Default to 1 (for grams or if unit is somehow not found)
            if (isset($units[$unitId])) {
                $conversionFactor = $units[$unitId]->conversion_factor;
            }

            // The key step: Convert the user-entered quantity into a standardized gram amount
            $quantityInGrams = $quantity * $conversionFactor;

            // Calculate nutrition using the correctly converted gram amount
            $total['calories'] += ($ingredient->calories_per_100g / 100) * $quantityInGrams;
            $total['protein']  += ($ingredient->protein_per_100g / 100) * $quantityInGrams;
            $total['fat']      += ($ingredient->fat_per_100g / 100) * $quantityInGrams;
            $total['carbs']    += ($ingredient->carbs_per_100g / 100) * $quantityInGrams;
        }

        // 5. Pass the accurately calculated data to the view
        return view('meals.show', [
            'meal' => $meal,
            'total' => $total,
            'units' => $units, // The view still needs this to display the unit abbreviation in the list
        ]);
    }

    public function destroy(Meal $meal)
    {
        if (auth()->user()->id !== $meal->user_id) {
            abort(403);
        }

        if ($meal->image_path) {
            Storage::disk('public')->delete($meal->image_path);
        }

        $meal->delete();

        return redirect()->route('dashboard')->with('success', 'Meal deleted successfully!');
    }

    public function edit(Meal $meal)
    {
        if (auth()->user()->id !== $meal->user_id) {
            abort(403);
        }

        $meal->load('ingredients');
        $ingredients = Ingredient::orderBy('name')->get();
        $ingredientsJson = $ingredients->keyBy('id');

        $units = Unit::all();
        $unitsJson = $units->keyBy('id');

        // --- NEW: CALCULATE INITIAL TOTALS ---
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
        // --- END OF NEW CALCULATION ---

        return view('meals.edit', [
            'meal' => $meal,
            'ingredients' => $ingredients,
            'units' => $units,
            'ingredientsJson' => $ingredientsJson,
            'unitsJson' => $unitsJson,
            'total' => $total, // <-- PASS THE CALCULATED TOTALS
        ]);
    }

    public function update(Request $request, Meal $meal)
    {
        if (auth()->user()->id !== $meal->user_id) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ingredients' => 'required|array|min:1',
            'ingredients.*.id' => 'required|exists:ingredients,id',
            'ingredients.*.quantity' => 'required|integer|min:1',
            'ingredients.*.unit_id' => 'required|exists:units,id',
        ]);

        DB::transaction(function () use ($request, $meal, $validated) {
            $imagePath = $meal->image_path;

            if ($request->hasFile('image')) {
                if ($meal->image_path) {
                    Storage::disk('public')->delete($meal->image_path);
                }
                $imagePath = $request->file('image')->store('meal-images', 'public');
            }

            $meal->update([
                'name' => $validated['name'],
                'image_path' => $imagePath,
            ]);

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

}
