<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MealController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    $meals = auth()->user()->meals()->latest()->get();

    return view('dashboard', [
        'meals' => $meals
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    Route::get('/meals/create', [MealController::class, 'create'])->name('meals.create');
    Route::post('/meals', [MealController::class, 'store'])->name('meals.store');
    Route::get('/meals/{meal}', [MealController::class, 'show'])->name('meals.show');
    Route::delete('/meals/{meal}', [MealController::class, 'destroy'])->name('meals.destroy');
    Route::get('/meals/{meal}/edit', [MealController::class, 'edit'])->name('meals.edit');
    Route::put('/meals/{meal}', [MealController::class, 'update'])->name('meals.update');

    Route::get('/users', [\App\Http\Controllers\FriendshipController::class, 'indexUsers'])->name('users.index');

    Route::prefix('friends')->name('friends.')->group(function () {
        Route::get('/', [\App\Http\Controllers\FriendshipController::class, 'index'])->name('index');
        Route::post('/add/{user}', [\App\Http\Controllers\FriendshipController::class, 'sendRequest'])->name('add');
        Route::post('/accept/{user}', [\App\Http\Controllers\FriendshipController::class, 'acceptRequest'])->name('accept');
        Route::post('/decline/{user}', [\App\Http\Controllers\FriendshipController::class, 'declineRequest'])->name('decline');
        Route::delete('/remove/{user}', [\App\Http\Controllers\FriendshipController::class, 'removeFriend'])->name('remove');
    });


});

require __DIR__.'/auth.php';
