<?php

namespace App\Providers;

use App\Models\Meal;         // <-- IMPORT MEAL MODEL
use App\Policies\MealPolicy; // <-- IMPORT MEAL POLICY
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Meal::class => MealPolicy::class, // <-- ADD THIS LINE
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
