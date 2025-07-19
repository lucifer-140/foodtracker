<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Nutrition Goals</h2>
                <p class="mt-1 text-sm text-gray-600">Set your daily targets to optimize your nutrition tracking</p>
            </div>
            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 text-sm font-medium rounded-lg shadow-sm hover:bg-gray-50 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-400 rounded-lg shadow-sm">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-green-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <p class="text-green-700 font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-6 sm:p-8">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Daily Nutrition Targets</h3>
                        <p class="mt-1 text-sm text-gray-500">Set your ideal daily intake for each macronutrient</p>
                    </div>

                    <form method="POST" action="{{ route('goals.update') }}">
                        @csrf

                        <div class="space-y-6">
                            <!-- Calories  -->
                            <div class="bg-blue-50 rounded-lg p-4 border border-blue-100">
                                <div class="flex items-center mb-2">
                                    <div class="p-2 rounded-full bg-blue-100 text-blue-600 mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <h4 class="font-medium text-gray-900">Calories</h4>
                                </div>
                                <div>
                                    <x-input-label for="daily_calories" value="Daily Target (kcal)" class="sr-only" />
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <x-text-input 
                                            id="daily_calories" 
                                            name="daily_calories" 
                                            type="number" 
                                            class="block w-full pl-4 pr-12 py-3 border-gray-300 rounded-lg" 
                                            :value="old('daily_calories', $goal->daily_calories)" 
                                            placeholder="e.g. 2000" 
                                        />
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500">kcal</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Macronutrients Grid -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <!-- Protein  -->
                                <div class="bg-white rounded-lg p-4 border border-gray-200 shadow-xs">
                                    <div class="flex items-center mb-3">
                                        <div class="p-2 rounded-full bg-green-100 text-green-600 mr-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <h4 class="font-medium text-gray-900">Protein</h4>
                                    </div>
                                    <div>
                                        <x-input-label for="daily_protein" value="Daily Target (g)" class="sr-only" />
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <x-text-input 
                                                id="daily_protein" 
                                                name="daily_protein" 
                                                type="number" 
                                                class="block w-full pl-4 pr-12 py-3 border-gray-300 rounded-lg" 
                                                :value="old('daily_protein', $goal->daily_protein)" 
                                                placeholder="e.g. 150" 
                                            />
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500">g</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Fat  -->
                                <div class="bg-white rounded-lg p-4 border border-gray-200 shadow-xs">
                                    <div class="flex items-center mb-3">
                                        <div class="p-2 rounded-full bg-yellow-100 text-yellow-600 mr-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <h4 class="font-medium text-gray-900">Fat</h4>
                                    </div>
                                    <div>
                                        <x-input-label for="daily_fat" value="Daily Target (g)" class="sr-only" />
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <x-text-input 
                                                id="daily_fat" 
                                                name="daily_fat" 
                                                type="number" 
                                                class="block w-full pl-4 pr-12 py-3 border-gray-300 rounded-lg" 
                                                :value="old('daily_fat', $goal->daily_fat)" 
                                                placeholder="e.g. 65" 
                                            />
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500">g</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Carbs  -->
                                <div class="bg-white rounded-lg p-4 border border-gray-200 shadow-xs">
                                    <div class="flex items-center mb-3">
                                        <div class="p-2 rounded-full bg-red-100 text-red-600 mr-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z" />
                                            </svg>
                                        </div>
                                        <h4 class="font-medium text-gray-900">Carbs</h4>
                                    </div>
                                    <div>
                                        <x-input-label for="daily_carbs" value="Daily Target (g)" class="sr-only" />
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <x-text-input 
                                                id="daily_carbs" 
                                                name="daily_carbs" 
                                                type="number" 
                                                class="block w-full pl-4 pr-12 py-3 border-gray-300 rounded-lg" 
                                                :value="old('daily_carbs', $goal->daily_carbs)" 
                                                placeholder="e.g. 250" 
                                            />
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500">g</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-4">
                                <x-primary-button class="w-full justify-center py-3 px-6 text-base font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    Save Nutrition Goals
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Recommended Values -->
            <div class="mt-8 bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-6 sm:p-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Recommended Daily Intake</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-medium text-gray-800 mb-2">For Weight Maintenance</h4>
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li class="flex items-start">
                                    <svg class="h-4 w-4 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Calories: ~2000-2500 kcal</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="h-4 w-4 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Protein: 0.8-1g per pound of body weight</span>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-800 mb-2">For Weight Loss</h4>
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li class="flex items-start">
                                    <svg class="h-4 w-4 text-blue-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Reduce calories by 300-500 kcal/day</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="h-4 w-4 text-blue-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Prioritize protein to preserve muscle</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>