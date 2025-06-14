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
        $units = Unit::orderBy('name')->get();

        return view('meals.create', [
            'ingredients' => $ingredients,
            'units' => $units,
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
        if (auth()->user()->id !== $meal->user_id) {
            abort(403);
        }

        $meal->load('ingredients');

        $total = [
            'calories' => 0,
            'protein' => 0,
            'fat' => 0,
            'carbs' => 0,
        ];

        foreach ($meal->ingredients as $ingredient) {

            $quantity = $ingredient->pivot->quantity;

            $total['calories'] += ($ingredient->calories_per_100g / 100) * $quantity;
            $total['protein']  += ($ingredient->protein_per_100g / 100) * $quantity;
            $total['fat']      += ($ingredient->fat_per_100g / 100) * $quantity;
            $total['carbs']    += ($ingredient->carbs_per_100g / 100) * $quantity;
        }

        $units = Unit::all()->keyBy('id');

        return view('meals.show', [
            'meal' => $meal,
            'total' => $total,
            'units' => $units,
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
        $units = Unit::orderBy('name')->get();

        return view('meals.edit', [
            'meal' => $meal,
            'ingredients' => $ingredients,
            'units' => $units,
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
