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

        $this->authorize('view', $meal);

        $meal->load('ingredients');

        $units = \App\Models\Unit::all()->keyBy('id');


        $total = [
            'calories' => 0,
            'protein' => 0,
            'fat' => 0,
            'carbs' => 0,
        ];


        foreach ($meal->ingredients as $ingredient) {

            $quantity = $ingredient->pivot->quantity;
            $unitId = $ingredient->pivot->unit_id;


            $conversionFactor = 1.0;
            if (isset($units[$unitId])) {
                $conversionFactor = $units[$unitId]->conversion_factor;
            }


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
        ]);
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
