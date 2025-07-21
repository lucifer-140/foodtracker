<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                    <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                    Nutrition Goals
                </h2>
                <p class="text-sm text-gray-500 mt-1">Customize your daily targets to optimize your nutrition journey</p>
            </div>

            <div class="flex items-center space-x-3">
                <a href="{{ route('reports.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    View Progress
                </a>
                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Dashboard
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            @if (session('success'))
                <div class="bg-green-50 border-l-4 border-green-400 rounded-lg p-4 shadow-sm animate-fade-in">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-green-700 font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @php
                $user = auth()->user();
                $recentMeals = $user->meals()->whereDate('created_at', today())->get();
                $todayCalories = $recentMeals->sum('calories');
                $todayProtein = $recentMeals->sum('protein');
                $todayCarbs = $recentMeals->sum('carbs');
                $todayFat = $recentMeals->sum('fat');
            @endphp

            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-100">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Today's Progress</h3>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        {{ $recentMeals->count() }} meals logged
                    </span>
                </div>

                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="bg-white rounded-lg p-4 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Calories</p>
                                <p class="text-xl font-bold text-gray-900">{{ $todayCalories }}</p>
                            </div>
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                            </div>
                        </div>
                        @if($goal->daily_calories)
                            <div class="mt-2">
                                <div class="flex justify-between text-xs text-gray-500 mb-1">
                                    <span>Goal: {{ $goal->daily_calories }} kcal</span>
                                    <span>{{ round(($todayCalories / $goal->daily_calories) * 100) }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-1.5">
                                    <div class="bg-blue-600 h-1.5 rounded-full transition-all duration-500" style="width: {{ min(100, ($todayCalories / $goal->daily_calories) * 100) }}%"></div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="bg-white rounded-lg p-4 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Protein</p>
                                <p class="text-xl font-bold text-gray-900">{{ $todayProtein }}g</p>
                            </div>
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"></path>
                                </svg>
                            </div>
                        </div>
                        @if($goal->daily_protein)
                            <div class="mt-2">
                                <div class="flex justify-between text-xs text-gray-500 mb-1">
                                    <span>Goal: {{ $goal->daily_protein }}g</span>
                                    <span>{{ round(($todayProtein / $goal->daily_protein) * 100) }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-1.5">
                                    <div class="bg-green-600 h-1.5 rounded-full transition-all duration-500" style="width: {{ min(100, ($todayProtein / $goal->daily_protein) * 100) }}%"></div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="bg-white rounded-lg p-4 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Carbs</p>
                                <p class="text-xl font-bold text-gray-900">{{ $todayCarbs }}g</p>
                            </div>
                            <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            </div>
                        </div>
                        @if($goal->daily_carbs)
                            <div class="mt-2">
                                <div class="flex justify-between text-xs text-gray-500 mb-1">
                                    <span>Goal: {{ $goal->daily_carbs }}g</span>
                                    <span>{{ round(($todayCarbs / $goal->daily_carbs) * 100) }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-1.5">
                                    <div class="bg-orange-600 h-1.5 rounded-full transition-all duration-500" style="width: {{ min(100, ($todayCarbs / $goal->daily_carbs) * 100) }}%"></div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="bg-white rounded-lg p-4 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Fat</p>
                                <p class="text-xl font-bold text-gray-900">{{ $todayFat }}g</p>
                            </div>
                            <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                        </div>
                        @if($goal->daily_fat)
                            <div class="mt-2">
                                <div class="flex justify-between text-xs text-gray-500 mb-1">
                                    <span>Goal: {{ $goal->daily_fat }}g</span>
                                    <span>{{ round(($todayFat / $goal->daily_fat) * 100) }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-1.5">
                                    <div class="bg-purple-600 h-1.5 rounded-full transition-all duration-500" style="width: {{ min(100, ($todayFat / $goal->daily_fat) * 100) }}%"></div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 sm:p-8 border-b border-gray-100 bg-gray-50">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900">Adjust Your Goals</h3>
                            <p class="text-sm text-gray-600 mt-1">Fine-tune your daily nutrition targets</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button onclick="resetToDefaults()" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Reset to Defaults</button>
                            <span class="text-gray-300">|</span>
                            <button onclick="calculateRecommended()" class="text-sm text-green-600 hover:text-green-800 font-medium">Auto Calculate</button>
                        </div>
                    </div>
                </div>

                <div class="p-6 sm:p-8">
                    <form method="POST" action="{{ route('goals.update', $goal) }}" id="goalsForm">
                        @csrf
                        @method('PUT')

                        <div class="space-y-8">
                            <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl p-6 border border-blue-200">
                                <div class="flex items-center mb-4">
                                    <div class="p-3 rounded-full bg-blue-200 text-blue-700 mr-4">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-lg font-semibold text-blue-900">Daily Calories</h4>
                                        <p class="text-sm text-blue-700">Your primary energy target</p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                    <div>
                                        <label for="daily_calories" class="block text-sm font-medium text-blue-800 mb-2">Target Calories</label>
                                        <div class="relative">
                                            <input type="number"
                                                   id="daily_calories"
                                                   name="daily_calories"
                                                   value="{{ old('daily_calories', $goal->daily_calories) }}"
                                                   class="block w-full pl-4 pr-16 py-3 border border-blue-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white @error('daily_calories') border-red-300 @enderror"
                                                   placeholder="e.g., 2000"
                                                   oninput="updateCalorieBreakdown()">
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <span class="text-blue-600 font-medium">kcal</span>
                                            </div>
                                        </div>
                                        @error('daily_calories')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="bg-white rounded-lg p-4 border border-blue-200">
                                        <h5 class="text-sm font-medium text-gray-700 mb-2">Calorie Breakdown</h5>
                                        <div class="space-y-2 text-sm">
                                            <div class="flex justify-between">
                                                <span class="text-gray-600">From Protein (25%):</span>
                                                <span class="font-medium" id="protein-calories">{{ $goal->daily_calories ? round($goal->daily_calories * 0.25) : 0 }} kcal</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span class="text-gray-600">From Carbs (45%):</span>
                                                <span class="font-medium" id="carbs-calories">{{ $goal->daily_calories ? round($goal->daily_calories * 0.45) : 0 }} kcal</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span class="text-gray-600">From Fat (30%):</span>
                                                <span class="font-medium" id="fat-calories">{{ $goal->daily_calories ? round($goal->daily_calories * 0.30) : 0 }} kcal</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                                <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 border border-green-200">
                                    <div class="flex items-center mb-4">
                                        <div class="p-2 rounded-full bg-green-200 text-green-700 mr-3">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-green-900">Protein</h4>
                                            <p class="text-xs text-green-700">Muscle building & repair</p>
                                        </div>
                                    </div>

                                    <div>
                                        <label for="daily_protein" class="block text-sm font-medium text-green-800 mb-2">Daily Target</label>
                                        <div class="relative">
                                            <input type="number"
                                                   id="daily_protein"
                                                   name="daily_protein"
                                                   value="{{ old('daily_protein', $goal->daily_protein) }}"
                                                   class="block w-full pl-4 pr-12 py-3 border border-green-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white @error('daily_protein') border-red-300 @enderror"
                                                   placeholder="e.g., 150">
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <span class="text-green-600 font-medium">g</span>
                                            </div>
                                        </div>
                                        @error('daily_protein')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror

                                        <div class="mt-3 p-3 bg-white rounded-lg border border-green-200">
                                            <p class="text-xs text-green-700">
                                                <span class="font-medium">Recommended:</span>
                                                <span id="protein-recommendation">0.8-1.2g per kg body weight</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl p-6 border border-orange-200">
                                    <div class="flex items-center mb-4">
                                        <div class="p-2 rounded-full bg-orange-200 text-orange-700 mr-3">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-orange-900">Carbohydrates</h4>
                                            <p class="text-xs text-orange-700">Primary energy source</p>
                                        </div>
                                    </div>

                                    <div>
                                        <label for="daily_carbs" class="block text-sm font-medium text-orange-800 mb-2">Daily Target</label>
                                        <div class="relative">
                                            <input type="number"
                                                   id="daily_carbs"
                                                   name="daily_carbs"
                                                   value="{{ old('daily_carbs', $goal->daily_carbs) }}"
                                                   class="block w-full pl-4 pr-12 py-3 border border-orange-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 bg-white @error('daily_carbs') border-red-300 @enderror"
                                                   placeholder="e.g., 250">
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <span class="text-orange-600 font-medium">g</span>
                                            </div>
                                        </div>
                                        @error('daily_carbs')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror

                                        <div class="mt-3 p-3 bg-white rounded-lg border border-orange-200">
                                            <p class="text-xs text-orange-700">
                                                <span class="font-medium">Recommended:</span>
                                                45-65% of total calories
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-6 border border-purple-200">
                                    <div class="flex items-center mb-4">
                                        <div class="p-2 rounded-full bg-purple-200 text-purple-700 mr-3">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-purple-900">Fat</h4>
                                            <p class="text-xs text-purple-700">Hormone production & vitamins</p>
                                        </div>
                                    </div>

                                    <div>
                                        <label for="daily_fat" class="block text-sm font-medium text-purple-800 mb-2">Daily Target</label>
                                        <div class="relative">
                                            <input type="number"
                                                   id="daily_fat"
                                                   name="daily_fat"
                                                   value="{{ old('daily_fat', $goal->daily_fat) }}"
                                                   class="block w-full pl-4 pr-12 py-3 border border-purple-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 bg-white @error('daily_fat') border-red-300 @enderror"
                                                   placeholder="e.g., 65">
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <span class="text-purple-600 font-medium">g</span>
                                            </div>
                                        </div>
                                        @error('daily_fat')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror

                                        <div class="mt-3 p-3 bg-white rounded-lg border border-purple-200">
                                            <p class="text-xs text-purple-700">
                                                <span class="font-medium">Recommended:</span>
                                                20-35% of total calories
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row gap-4 pt-6">
                                <button type="submit" class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Save Nutrition Goals
                                </button>

                                <a href="{{ route('meals.create') }}" class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Log Your Next Meal
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-indigo-50 to-purple-50">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                            Smart Recommendations
                        </h3>
                        <p class="text-sm text-gray-600 mt-1">Based on your current progress</p>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @if($todayCalories < ($goal->daily_calories * 0.8))
                                <div class="flex items-start space-x-3 p-3 bg-yellow-50 rounded-lg border border-yellow-200">
                                    <div class="w-6 h-6 bg-yellow-200 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <svg class="w-3 h-3 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-yellow-800">Increase Calorie Intake</div>
                                        <div class="text-xs text-yellow-600 mt-1">You're {{ $goal->daily_calories - $todayCalories }} calories below your goal today</div>
                                    </div>
                                </div>
                            @elseif($todayCalories > ($goal->daily_calories * 1.2))
                                <div class="flex items-start space-x-3 p-3 bg-red-50 rounded-lg border border-red-200">
                                    <div class="w-6 h-6 bg-red-200 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <svg class="w-3 h-3 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-red-800">Consider Portion Control</div>
                                        <div class="text-xs text-red-600 mt-1">You're {{ $todayCalories - $goal->daily_calories }} calories over your goal</div>
                                    </div>
                                </div>
                            @else
                                <div class="flex items-start space-x-3 p-3 bg-green-50 rounded-lg border border-green-200">
                                    <div class="w-6 h-6 bg-green-200 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-green-800">Great Progress!</div>
                                        <div class="text-xs text-green-600 mt-1">You're on track with your calorie goal today</div>
                                    </div>
                                </div>
                            @endif

                            @if($goal->daily_protein && $todayProtein < ($goal->daily_protein * 0.8))
                                <div class="flex items-start space-x-3 p-3 bg-blue-50 rounded-lg border border-blue-200">
                                    <div class="w-6 h-6 bg-blue-200 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <svg class="w-3 h-3 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-blue-800">Boost Protein Intake</div>
                                        <div class="text-xs text-blue-600 mt-1">Add {{ $goal->daily_protein - $todayProtein }}g more protein today</div>
                                    </div>
                                </div>
                            @endif

                            <div class="flex items-start space-x-3 p-3 bg-purple-50 rounded-lg border border-purple-200">
                                <div class="w-6 h-6 bg-purple-200 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <svg class="w-3 h-3 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-purple-800">Stay Consistent</div>
                                    <div class="text-xs text-purple-600 mt-1">Log meals regularly for better insights</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-green-50 to-blue-50">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            Nutrition Guidelines
                        </h3>
                        <p class="text-sm text-gray-600 mt-1">Evidence-based recommendations</p>
                    </div>
                    <div class="p-6">
                        <div class="space-y-6">
                            <div>
                                <h4 class="font-medium text-gray-800 mb-3 flex items-center">
                                    <span class="w-2 h-2 bg-blue-500 rounded-full mr-2"></span>
                                    For Weight Maintenance
                                </h4>
                                <ul class="space-y-2 text-sm text-gray-600 ml-4">
                                    <li class="flex items-start">
                                        <svg class="h-4 w-4 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span>Calories: 2000-2500 kcal (varies by activity level)</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="h-4 w-4 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span>Protein: 0.8-1.2g per kg body weight</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="h-4 w-4 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span>Carbs: 45-65% of total calories</span>
                                    </li>
                                </ul>
                            </div>

                            <div>
                                <h4 class="font-medium text-gray-800 mb-3 flex items-center">
                                    <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span>
                                    For Weight Loss
                                </h4>
                                <ul class="space-y-2 text-sm text-gray-600 ml-4">
                                    <li class="flex items-start">
                                        <svg class="h-4 w-4 text-blue-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span>Create 300-500 kcal daily deficit</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="h-4 w-4 text-blue-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span>Higher protein (1.2-1.6g per kg) to preserve muscle</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="h-4 w-4 text-blue-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span>Focus on whole foods and fiber</span>
                                    </li>
                                </ul>
                            </div>

                            <div>
                                <h4 class="font-medium text-gray-800 mb-3 flex items-center">
                                    <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                    For Muscle Gain
                                </h4>
                                <ul class="space-y-2 text-sm text-gray-600 ml-4">
                                    <li class="flex items-start">
                                        <svg class="h-4 w-4 text-purple-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span>Slight caloric surplus (200-500 kcal)</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="h-4 w-4 text-purple-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span>High protein (1.6-2.2g per kg body weight)</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="h-4 w-4 text-purple-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span>Adequate carbs for training fuel</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateCalorieBreakdown() {
            const calories = document.getElementById('daily_calories').value || 0;
            document.getElementById('protein-calories').textContent = Math.round(calories * 0.25) + ' kcal';
            document.getElementById('carbs-calories').textContent = Math.round(calories * 0.45) + ' kcal';
            document.getElementById('fat-calories').textContent = Math.round(calories * 0.30) + ' kcal';
        }

        function resetToDefaults() {
            if (confirm('Reset all goals to recommended defaults?')) {
                document.getElementById('daily_calories').value = 2000;
                document.getElementById('daily_protein').value = 150;
                document.getElementById('daily_carbs').value = 225;
                document.getElementById('daily_fat').value = 67;
                updateCalorieBreakdown();
            }
        }

        function calculateRecommended() {
            const weight = prompt('Enter your weight in kg (optional):');
            if (weight && !isNaN(weight)) {
                const protein = Math.round(weight * 1.2);
                document.getElementById('daily_protein').value = protein;

                document.getElementById('protein-recommendation').textContent = `${Math.round(weight * 0.8)}-${Math.round(weight * 1.6)}g for your weight`;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateCalorieBreakdown();
        });
    </script>

    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fade-in 0.3s ease-out;
        }

        .hover-scale:hover {
            transform: scale(1.02);
            transition: transform 0.2s ease-in-out;
        }
    </style>
</x-app-layout>
