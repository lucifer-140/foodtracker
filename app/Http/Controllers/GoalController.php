<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoalController extends Controller
{

    public function edit()
    {

        $goal = auth()->user()->goal()->firstOrCreate([]);

        return view('goals.edit', compact('goal'));
    }


    public function update(Request $request)
    {
        $validated = $request->validate([
            'daily_calories' => 'nullable|integer|min:0',
            'daily_protein' => 'nullable|integer|min:0',
            'daily_fat' => 'nullable|integer|min:0',
            'daily_carbs' => 'nullable|integer|min:0',
        ]);


        auth()->user()->goal()->updateOrCreate([], $validated);

        return redirect()->route('goals.edit')->with('success', 'Your goals have been saved!');
    }
}
