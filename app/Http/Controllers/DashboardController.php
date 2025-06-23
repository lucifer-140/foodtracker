<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        // Get ALL of the user's meals, sorted by newest first.
        // We use ->get() here because your new stats widgets need to count
        // items from the entire collection (e.g., meals today, this week).
        $meals = $user->meals()->latest()->get();

        // Pass the full collection of meals to the dashboard view.
        return view('dashboard', [
            'meals' => $meals,
        ]);
    }
}
