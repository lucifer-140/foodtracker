<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
            <div class="mb-4 sm:mb-0">
                <h2 class="text-2xl font-bold text-gray-900">Meal Archive</h2>
                <p class="mt-1 text-sm text-gray-600">Your complete meal history compared to your goals</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('meals.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Add Meal
                </a>
                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 text-sm font-medium rounded-lg shadow-sm hover:bg-gray-50 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Dashboard
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @php
                // Get user's goals with fallback defaults
                $goal = auth()->user()->goal ?? (object)[
                    'daily_calories' => 2000,
                    'daily_protein' => 120,
                    'daily_fat' => 60,
                    'daily_carbs' => 250
                ];
            @endphp

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <!-- Nutrition Goals Summary -->
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <h3 class="text-lg font-medium text-gray-900">Your Nutrition Goals</h3>
                        <div class="flex flex-wrap gap-3">
                            <span class="text-sm bg-blue-50 text-blue-800 px-3 py-1 rounded-full">Calories: {{ $goal->daily_calories }} kcal</span>
                            <span class="text-sm bg-blue-100 text-blue-800 px-3 py-1 rounded-full">Protein: {{ $goal->daily_protein }}g</span>
                            <span class="text-sm bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full">Fat: {{ $goal->daily_fat }}g</span>
                            <span class="text-sm bg-green-100 text-green-800 px-3 py-1 rounded-full">Carbs: {{ $goal->daily_carbs }}g</span>
                        </div>
                    </div>
                </div>
                
                <!-- Meal Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Time</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Meal Details</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nutrition</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($meals as $meal)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $meal->created_at->format('M d, Y') }}</div>
                                    <div class="text-xs text-gray-500">{{ $meal->created_at->format('h:i A') }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $meal->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $meal->category ?? 'Meal' }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col sm:flex-row sm:items-center gap-2">
                                        <!-- Calories compared to goal -->
                                        <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $meal->calories > $goal->daily_calories ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                            {{ $meal->calories }} kcal
                                        </span>
                                        <div class="flex gap-2">
                                            <!-- Macros -->
                                            <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded">P: {{ $meal->protein }}g</span>
                                            <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">F: {{ $meal->fat }}g</span>
                                            <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">C: {{ $meal->carbs }}g</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex gap-3">
                                        <a href="{{ route('meals.show', $meal) }}" class="text-indigo-600 hover:text-indigo-900 text-sm inline-flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                            </svg>
                                            View
                                        </a>
                                        <a href="{{ route('meals.edit', $meal) }}" class="text-blue-600 hover:text-blue-900 text-sm inline-flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('meals.destroy', $meal) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 text-sm inline-flex items-center" onclick="return confirm('Are you sure you want to delete this meal?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($meals->hasPages())
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-500">
                            Showing {{ $meals->firstItem() }} to {{ $meals->lastItem() }} of {{ $meals->total() }} meals
                        </div>
                        <div class="flex space-x-2">
                            @if($meals->onFirstPage())
                                <span class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-400 bg-gray-50 cursor-not-allowed">
                                    Previous
                                </span>
                            @else
                                <a href="{{ $meals->previousPageUrl() }}" class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                    Previous
                                </a>
                            @endif

                            @if($meals->hasMorePages())
                                <a href="{{ $meals->nextPageUrl() }}" class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                    Next
                                </a>
                            @else
                                <span class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-400 bg-gray-50 cursor-not-allowed">
                                    Next
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>