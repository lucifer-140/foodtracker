<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                    <svg class="w-6 h-6 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.196-2.121M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.196-2.121M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    My Feed
                </h2>
                <p class="mt-1 text-sm text-gray-500">See what your friends have been tracking recently</p>
            </div>

            <div class="flex items-center space-x-4">
                <!-- Search Bar -->
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text"
                           placeholder="Search meals or friends..."
                           class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-green-500 focus:border-green-500 sm:text-sm">
                </div>

                <!-- Filter Dropdown -->
                <div class="relative">
                    <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.414A1 1 0 013 6.707V4z"></path>
                        </svg>
                        Filter
                    </button>
                </div>

                <!-- Find Friends Button -->
                <a href="{{ route('users.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm hover:shadow-md transform hover:scale-105">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Find Friends
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <!-- Feed Stats -->
            <div class="mb-8 bg-gradient-to-r from-green-50 to-blue-50 rounded-2xl p-6 border border-green-100">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Your Community</h3>
                        <p class="text-gray-600">Stay motivated with your friends' healthy choices</p>
                    </div>
                    <div class="flex space-x-6 text-center">
                        <div class="bg-white/80 rounded-lg px-4 py-3 shadow-sm">
                            <div class="text-2xl font-bold text-green-600">{{ $meals->total() ?? 0 }}</div>
                            <div class="text-sm text-gray-500">Recent Meals</div>
                        </div>
                        <div class="bg-white/80 rounded-lg px-4 py-3 shadow-sm">
                            <div class="text-2xl font-bold text-blue-600">{{ $meals->groupBy('user_id')->count() ?? 0 }}</div>
                            <div class="text-sm text-gray-500">Active Friends</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                @forelse ($meals as $meal)
                    <article class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <!-- User Header -->
                        <div class="p-4 border-b border-gray-100">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="relative">
                                        <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-blue-500 rounded-full flex items-center justify-center flex-shrink-0 shadow-md">
                                            <span class="text-white font-semibold text-lg">
                                                {{ strtoupper(substr($meal->user->name, 0, 1)) }}
                                            </span>
                                        </div>
                                        <!-- Online indicator -->
                                        <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-400 border-2 border-white rounded-full"></div>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-900 hover:text-green-600 cursor-pointer transition-colors">
                                            {{ $meal->user->name }}
                                        </div>
                                        <div class="text-sm text-gray-500 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $meal->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Menu -->
                                <div class="relative">
                                    <button class="p-2 text-gray-400 hover:text-gray-600 rounded-full hover:bg-gray-100 transition-colors">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Meal Content -->
                        <a href="{{ route('friends.meals.show', $meal) }}" class="block group">
                            <div class="p-6">
                                <div class="mb-4">
                                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-green-600 transition-colors mb-2">
                                        {{ $meal->name }}
                                    </h3>
                                    <p class="text-gray-600 text-sm">
                                        Just logged a delicious meal! Click to see the full nutritional breakdown and ingredients.
                                    </p>
                                </div>

                                <!-- Meal Image -->
                                <div class="relative mb-4">
                                    @if ($meal->image_path)
                                        <img class="w-full h-64 object-cover rounded-xl group-hover:scale-[1.02] transition-transform duration-300"
                                             src="{{ asset('storage/' . $meal->image_path) }}"
                                             alt="{{ $meal->name }}">
                                    @else
                                        <div class="w-full h-64 bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl flex items-center justify-center group-hover:from-gray-200 group-hover:to-gray-300 transition-all duration-300">
                                            <div class="text-center">
                                                <svg class="w-16 h-16 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 19v-1.5a2.5 2.5 0 012.5-2.5h13A2.5 2.5 0 0121 17.5V19m-18 0a2.5 2.5 0 002.5 2.5h13A2.5 2.5 0 0021 19m-18 0h18M9 12a4 4 0 100-8 4 4 0 000 8z"></path>
                                                </svg>
                                                <p class="text-gray-500 text-sm">{{ $meal->name }}</p>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Nutrition Overlay -->
                                    @if(isset($meal->total_calories))
                                        <div class="absolute top-4 right-4 bg-black/70 backdrop-blur-sm text-white px-3 py-2 rounded-lg text-sm font-medium">
                                            {{ round($meal->total_calories) }} cal
                                        </div>
                                    @endif
                                </div>

                                <!-- Quick Nutrition Stats -->
                                <div class="grid grid-cols-4 gap-3 mb-4">
                                    @php
                                        // Calculate nutrition totals for this meal
                                        $totals = ['calories' => 0, 'protein' => 0, 'fat' => 0, 'carbs' => 0];
                                        foreach ($meal->ingredients as $ingredient) {
                                            $unitData = $units[$ingredient->pivot->unit_id] ?? null;
                                            if ($unitData) {
                                                $conversionFactor = $unitData->conversion_factor;
                                                $quantityInGrams = $ingredient->pivot->quantity * $conversionFactor;
                                                $totals['calories'] += ($ingredient->calories_per_100g / 100) * $quantityInGrams;
                                                $totals['protein'] += ($ingredient->protein_per_100g / 100) * $quantityInGrams;
                                                $totals['fat'] += ($ingredient->fat_per_100g / 100) * $quantityInGrams;
                                                $totals['carbs'] += ($ingredient->carbs_per_100g / 100) * $quantityInGrams;
                                            }
                                        }
                                    @endphp

                                    <div class="bg-blue-50 p-3 rounded-lg text-center">
                                        <div class="text-sm font-medium text-blue-600">Calories</div>
                                        <div class="text-lg font-bold text-blue-800">{{ round($totals['calories']) }}</div>
                                    </div>
                                    <div class="bg-green-50 p-3 rounded-lg text-center">
                                        <div class="text-sm font-medium text-green-600">Protein</div>
                                        <div class="text-lg font-bold text-green-800">{{ round($totals['protein']) }}g</div>
                                    </div>
                                    <div class="bg-yellow-50 p-3 rounded-lg text-center">
                                        <div class="text-sm font-medium text-yellow-600">Fat</div>
                                        <div class="text-lg font-bold text-yellow-800">{{ round($totals['fat']) }}g</div>
                                    </div>
                                    <div class="bg-red-50 p-3 rounded-lg text-center">
                                        <div class="text-sm font-medium text-red-600">Carbs</div>
                                        <div class="text-lg font-bold text-red-800">{{ round($totals['carbs']) }}g</div>
                                    </div>
                                </div>

                                <!-- Ingredients Preview -->
                                <div class="flex items-center text-sm text-gray-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                    {{ $meal->ingredients->count() }} ingredients
                                    @if($meal->ingredients->count() > 0)
                                        • {{ $meal->ingredients->take(3)->pluck('name')->join(', ') }}
                                        @if($meal->ingredients->count() > 3)
                                            and {{ $meal->ingredients->count() - 3 }} more
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </a>

                        <!-- Interaction Bar -->
                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-6">
                                    <button class="flex items-center space-x-2 text-gray-500 hover:text-red-500 transition-colors group">
                                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                        </svg>
                                        <span class="text-sm font-medium">Like</span>
                                    </button>

                                    <button class="flex items-center space-x-2 text-gray-500 hover:text-blue-500 transition-colors group">
                                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                        </svg>
                                        <span class="text-sm font-medium">Comment</span>
                                    </button>

                                    <button class="flex items-center space-x-2 text-gray-500 hover:text-green-500 transition-colors group">
                                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                                        </svg>
                                        <span class="text-sm font-medium">Share</span>
                                    </button>
                                </div>

                                <button class="flex items-center space-x-2 text-gray-500 hover:text-purple-500 transition-colors group">
                                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                                    </svg>
                                    <span class="text-sm font-medium">Save</span>
                                </button>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="bg-white rounded-2xl shadow-lg text-center py-16 border border-gray-100">
                        <div class="max-w-md mx-auto">
                            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.196-2.121M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.196-2.121M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Your Feed is Empty</h3>
                            <p class="text-gray-500 mb-6">When your friends post meals, they'll show up here. Start by connecting with other users!</p>
                            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                                <a href="{{ route('users.index') }}"
                                   class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition-colors shadow-md hover:shadow-lg transform hover:scale-105">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Find Friends
                                </a>
                                <a href="{{ route('meals.create') }}"
                                   class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors shadow-md hover:shadow-lg transform hover:scale-105">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Share Your First Meal
                                </a>
                            </div>
                        </div>
                    </div>
                @endforelse

                <!-- Pagination -->
                @if($meals->hasPages())
                    <div class="mt-8">
                        {{ $meals->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
