<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MealController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\GoalController;

//Route::get('/ping', function () {
//    return 'Pong!';
//});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

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
    Route::get('/meal-archive', [MealController::class, 'archive'])->name('meals.archive');



    Route::get('/users', [\App\Http\Controllers\FriendshipController::class, 'indexUsers'])->name('users.index');
    Route::get('/users/{user}', [\App\Http\Controllers\FriendshipController::class, 'showUserProfile'])->name('users.show');

    Route::prefix('friends')->name('friends.')->group(function () {
        Route::get('/', [\App\Http\Controllers\FriendshipController::class, 'index'])->name('index');
        Route::post('/add/{user}', [\App\Http\Controllers\FriendshipController::class, 'sendRequest'])->name('add');
        Route::post('/accept/{user}', [\App\Http\Controllers\FriendshipController::class, 'acceptRequest'])->name('accept');
        Route::post('/decline/{user}', [\App\Http\Controllers\FriendshipController::class, 'declineRequest'])->name('decline');
        Route::delete('/remove/{user}', [\App\Http\Controllers\FriendshipController::class, 'removeFriend'])->name('remove');
    });

    Route::get('/feed', [\App\Http\Controllers\FeedController::class, 'index'])->name('feed.index');
    Route::get('/friends/meals/{meal}', [\App\Http\Controllers\FeedController::class, 'showFriendMeal'])->name('friends.meals.show');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');


    Route::get('/goals', [GoalController::class, 'edit'])->name('goals.edit');
    Route::post('/goals', [GoalController::class, 'update'])->name('goals.update');


});

require __DIR__.'/auth.php';
