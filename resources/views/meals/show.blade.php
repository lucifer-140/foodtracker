<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight flex items-center">
                    <svg class="w-6 h-6 mr-3 text-green-600" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                        <g>
                            <path d="M128 352.576V352a288 288 0 0 1 491.072-204.224 192 192 0 0 1 274.24 204.48 64 64 0 0 1 57.216 74.24C921.6 600.512 850.048 710.656 736 756.992V800a96 96 0 0 1-96 96H384a96 96 0 0 1-96-96v-43.008c-114.048-46.336-185.6-156.48-214.528-330.496A64 64 0 0 1 128 352.64zm64-.576h64a160 160 0 0 1 320 0h64a224 224 0 0 0-448 0zm128 0h192a96 96 0 0 0-192 0zm439.424 0h68.544A128.256 128.256 0 0 0 704 192c-15.36 0-29.952 2.688-43.52 7.616 11.328 18.176 20.672 37.76 27.84 58.304A64.128 64.128 0 0 1 759.424 352zM672 768H352v32a32 32 0 0 0 32 32h256a32 32 0 0 0 32-32v-32zm-342.528-64h365.056c101.504-32.64 165.76-124.928 192.896-288H136.576c27.136 163.072 91.392 255.36 192.896 288z"></path>
                        </g>
                    </svg>
                    {{ $meal->name }}
                </h2>
                <div class="flex items-center mt-2 text-sm text-gray-600 space-x-4">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-1" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                            <g>
                                <path d="M19,4H17V3a1,1,0,0,0-2,0V4H9V3A1,1,0,0,0,7,3V4H5A3,3,0,0,0,2,7V19a3,3,0,0,0,3,3H19a3,3,0,0,0,3-3V7A3,3,0,0,0,19,4Zm1,15a1,1,0,0,1-1,1H5a1,1,0,0,1-1-1V12H20Zm0-9H4V7A1,1,0,0,1,5,6H7V7A1,1,0,0,0,9,7V6h6V7a1,1,0,0,0,2,0V6h2a1,1,0,0,1,1,1Z"></path>
                            </g>
                        </svg>
                        {{ $meal->created_at->format('M j, Y') }}
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ $meal->created_at->format('g:i A') }}
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        {{ $meal->ingredients->count() }} ingredients
                    </div>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <a href="{{ route('meals.edit', $meal) }}"
                   class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm hover:shadow-md transform hover:scale-105">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Meal
                </a>

                <form method="POST" action="{{ route('meals.destroy', $meal) }}" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            onclick="return confirm('Are you sure you want to delete this meal? This action cannot be undone.')"
                            class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm hover:shadow-md transform hover:scale-105">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Delete
                    </button>
                </form>

                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Dashboard
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg shadow animate-pulse" role="alert">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Meal Image -->
                    @if ($meal->image_path)
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
                            <div class="relative">
                                <img class="w-full h-80 object-cover" src="{{ asset('storage/' . $meal->image_path) }}" alt="{{ $meal->name }}">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                                <div class="absolute bottom-4 left-4 right-4">
                                    <div class="flex items-center justify-between">
                                        <div class="bg-white/90 backdrop-blur-sm rounded-lg px-3 py-2">
                                            <div class="text-sm font-medium text-gray-800">{{ round($total['calories']) }} calories</div>
                                        </div>
                                        <div class="bg-white/90 backdrop-blur-sm rounded-lg px-3 py-2">
                                            <div class="text-sm font-medium text-gray-800">{{ $meal->created_at->format('g:i A') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
                            <div class="text-center">
                                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-1.5a2.5 2.5 0 012.5-2.5h13A2.5 2.5 0 0121 17.5V19"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">{{ $meal->name }}</h3>
                                <p class="text-gray-500">No image available for this meal</p>
                            </div>
                        </div>
                    @endif

                    <!-- Nutritional Breakdown Chart -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            Nutritional Breakdown
                        </h3>

                        <!-- Macronutrient Distribution -->
                        @php
                            $totalMacros = $total['protein'] + $total['fat'] + $total['carbs'];
                            $proteinPercent = $totalMacros > 0 ? ($total['protein'] / $totalMacros) * 100 : 0;
                            $fatPercent = $totalMacros > 0 ? ($total['fat'] / $totalMacros) * 100 : 0;
                            $carbsPercent = $totalMacros > 0 ? ($total['carbs'] / $totalMacros) * 100 : 0;
                        @endphp

                        <div class="mb-6">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700">Macronutrient Distribution</span>
                                <span class="text-sm text-gray-500">{{ round($totalMacros) }}g total</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                                <div class="h-full flex">
                                    <div class="bg-green-500 transition-all duration-1000 ease-out" style="width: {{ $proteinPercent }}%"></div>
                                    <div class="bg-yellow-500 transition-all duration-1000 ease-out" style="width: {{ $fatPercent }}%"></div>
                                    <div class="bg-red-500 transition-all duration-1000 ease-out" style="width: {{ $carbsPercent }}%"></div>
                                </div>
                            </div>
                            <div class="flex justify-between mt-2 text-xs">
                                <span class="text-green-600">Protein {{ round($proteinPercent) }}%</span>
                                <span class="text-yellow-600">Fat {{ round($fatPercent) }}%</span>
                                <span class="text-red-600">Carbs {{ round($carbsPercent) }}%</span>
                            </div>
                        </div>

                        <!-- Detailed Nutrition Cards -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-4 rounded-xl border border-blue-200 text-center transform hover:scale-105 transition-transform">
                                <div class="w-12 h-12 bg-blue-200 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <div class="text-sm font-medium text-blue-600 mb-1">Calories</div>
                                <div class="text-2xl font-bold text-blue-800">{{ round($total['calories']) }}</div>
                                <div class="text-xs text-blue-500">kcal</div>
                            </div>

                            <div class="bg-gradient-to-br from-green-50 to-green-100 p-4 rounded-xl border border-green-200 text-center transform hover:scale-105 transition-transform">
                                <div class="w-12 h-12 bg-green-200 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </div>
                                <div class="text-sm font-medium text-green-600 mb-1">Protein</div>
                                <div class="text-2xl font-bold text-green-800">{{ round($total['protein']) }}</div>
                                <div class="text-xs text-green-500">grams</div>
                            </div>

                            <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 p-4 rounded-xl border border-yellow-200 text-center transform hover:scale-105 transition-transform">
                                <div class="w-12 h-12 bg-yellow-200 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"></path>
                                    </svg>
                                </div>
                                <div class="text-sm font-medium text-yellow-600 mb-1">Fat</div>
                                <div class="text-2xl font-bold text-yellow-800">{{ round($total['fat']) }}</div>
                                <div class="text-xs text-yellow-500">grams</div>
                            </div>

                            <div class="bg-gradient-to-br from-red-50 to-red-100 p-4 rounded-xl border border-red-200 text-center transform hover:scale-105 transition-transform">
                                <div class="w-12 h-12 bg-red-200 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                </div>
                                <div class="text-sm font-medium text-red-600 mb-1">Carbs</div>
                                <div class="text-2xl font-bold text-red-800">{{ round($total['carbs']) }}</div>
                                <div class="text-xs text-red-500">grams</div>
                            </div>
                        </div>
                    </div>

                    <!-- Ingredients List -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
                            <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                                Ingredients ({{ $meal->ingredients->count() }})
                            </h3>
                            <p class="text-sm text-gray-600 mt-1">Complete list of ingredients used in this meal</p>
                        </div>

                        <div class="p-6">
                            <div class="space-y-4">
                                @foreach ($meal->ingredients as $index => $ingredient)
                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                                        <div class="flex items-center space-x-4">
                                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-600 font-semibold text-sm">
                                                {{ $index + 1 }}
                                            </div>
                                            <div>
                                                <h4 class="font-medium text-gray-900">{{ $ingredient->name }}</h4>
                                                <p class="text-sm text-gray-500">
                                                    {{ $ingredient->pivot->quantity }} {{ $units[$ingredient->pivot->unit_id]->abbreviation }}
                                                </p>
                                            </div>
                                        </div>

                                        @php
                                            $unitData = $units[$ingredient->pivot->unit_id];
                                            $conversionFactor = $unitData->conversion_factor;
                                            $quantityInGrams = $ingredient->pivot->quantity * $conversionFactor;
                                            $ingredientCalories = ($ingredient->calories_per_100g / 100) * $quantityInGrams;
                                        @endphp

                                        <div class="text-right">
                                            <div class="text-sm font-medium text-gray-900">{{ round($ingredientCalories) }} cal</div>
                                            <div class="text-xs text-gray-500">{{ round($quantityInGrams) }}g</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Quick Stats -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Quick Stats
                        </h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Meal Date</span>
                                <span class="text-sm font-medium text-gray-900">{{ $meal->created_at->format('M j, Y') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Time Logged</span>
                                <span class="text-sm font-medium text-gray-900">{{ $meal->created_at->format('g:i A') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Ingredients</span>
                                <span class="text-sm font-medium text-gray-900">{{ $meal->ingredients->count() }} items</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Total Weight</span>
                                <span class="text-sm font-medium text-gray-900">
                                    @php
                                        $totalWeight = 0;
                                        foreach ($meal->ingredients as $ingredient) {
                                            $unitData = $units[$ingredient->pivot->unit_id];
                                            $totalWeight += $ingredient->pivot->quantity * $unitData->conversion_factor;
                                        }
                                    @endphp
                                    {{ round($totalWeight) }}g
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Contribution to Daily Goals
                        </h3>

                        @if ($goal)

                            @php
                                $dailyGoals = [
                                    'calories' => $goal->daily_calories ?? 2000,
                                    'protein'  => $goal->daily_protein  ?? 150,
                                    'fat'      => $goal->daily_fat      ?? 65,
                                    'carbs'    => $goal->daily_carbs    ?? 250
                                ];
                            @endphp

                            <div class="space-y-4">
                                @foreach(['calories' => 'kcal', 'protein' => 'g', 'fat' => 'g', 'carbs' => 'g'] as $nutrient => $unit)
                                    @php
                                        $current = $total[$nutrient];
                                        $goalValue = $dailyGoals[$nutrient];
                                        $percentage = $goalValue > 0 ? min(($current / $goalValue) * 100, 100) : 0;
                                        $color = $nutrient === 'calories' ? 'blue' : ($nutrient === 'protein' ? 'green' : ($nutrient === 'fat' ? 'yellow' : 'red'));
                                    @endphp

                                    <div>
                                        <div class="flex justify-between items-center mb-1">
                                            <span class="text-sm font-medium text-gray-700 capitalize">{{ $nutrient }}</span>
                                            <span class="text-sm text-gray-500">{{ round($current) }} / {{ $goalValue }}{{ $unit }}</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-{{ $color }}-500 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                                        </div>
                                        <div class="text-xs text-gray-500 mt-1">{{ round($percentage) }}% of daily goal</div>
                                    </div>
                                @endforeach
                            </div>

                        @else

                            <div class="text-center py-4">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-lg font-medium text-gray-900 mb-2">No goals set yet</h4>
                                <p class="text-gray-500 mb-4 text-sm">Set your goals to see how this meal contributes to your daily progress.</p>
                                <a href="{{ route('goals.edit') }}" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors">
                                    Set Your Goals
                                </a>
                            </div>

                        @endif
                    </div>

                    <!-- Actions -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                            </svg>
                            Actions
                        </h3>
                        <div class="space-y-3">
                            <button class="w-full flex items-center justify-center px-4 py-2 bg-green-100 hover:bg-green-200 text-green-700 text-sm font-medium rounded-lg transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                                Duplicate Meal
                            </button>
                            <button class="w-full flex items-center justify-center px-4 py-2 bg-blue-100 hover:bg-blue-200 text-blue-700 text-sm font-medium rounded-lg transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                                </svg>
                                Share Meal
                            </button>
                            <button class="w-full flex items-center justify-center px-4 py-2 bg-purple-100 hover:bg-purple-200 text-purple-700 text-sm font-medium rounded-lg transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Export Data
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
