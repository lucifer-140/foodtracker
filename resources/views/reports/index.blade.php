<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                    <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Nutrition Analytics
                </h2>
                <p class="text-sm text-gray-500 mt-1">Comprehensive insights into your nutrition journey</p>
            </div>

            <div class="flex items-center space-x-3">

                <div class="flex items-center space-x-2 bg-white rounded-lg border border-gray-200 p-1">
                    <button class="px-3 py-1 text-sm bg-blue-600 text-white rounded-md font-medium">Week</button>
                    <button class="px-3 py-1 text-sm text-gray-600 hover:bg-gray-100 rounded-md">Month</button>
                    <button class="px-3 py-1 text-sm text-gray-600 hover:bg-gray-100 rounded-md">Year</button>
                </div>

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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">


            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-blue-600">Average Daily</p>
                            <h3 class="text-2xl font-bold text-blue-900 mt-1">{{ $avgDailyCalories }}</h3>
                            <p class="text-xs text-blue-700 mt-1">kcal per day</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-200 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center">
                        <div class="flex-1 bg-blue-200 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $goal && $goal->daily_calories ? min(100, ($avgDailyCalories / $goal->daily_calories) * 100) : 0 }}%"></div>
                        </div>
                        <span class="ml-2 text-xs text-blue-600 font-medium">{{ $goal && $goal->daily_calories ? round(($avgDailyCalories / $goal->daily_calories) * 100) : 0 }}%</span>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-6 border border-green-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-green-600">Best Day</p>
                            <h3 class="text-2xl font-bold text-green-900 mt-1">{{ $maxCalories }}</h3>
                            <p class="text-xs text-green-700 mt-1">{{ $maxCaloriesDay }}</p>
                        </div>
                        <div class="w-12 h-12 bg-green-200 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        @if($maxCalories > 0)
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Peak Performance
                            </span>
                        @else
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                No data yet
                            </span>
                        @endif
                    </div>
                </div>

                <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl p-6 border border-purple-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-purple-600">Weekly Total</p>
                            <h3 class="text-2xl font-bold text-purple-900 mt-1">{{ number_format($weeklyTotal) }}</h3>
                            <p class="text-xs text-purple-700 mt-1">kcal this week</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-200 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <span class="text-xs text-purple-600">
                            Goal: {{ $goal && $goal->daily_calories ? number_format($goal->daily_calories * 7) : 'Not set' }} kcal
                        </span>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-2xl p-6 border border-orange-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-orange-600">Goal Achievement</p>
                            <h3 class="text-2xl font-bold text-orange-900 mt-1">{{ $daysOnTarget }}/7</h3>
                            <p class="text-xs text-orange-700 mt-1">days on target</p>
                        </div>
                        <div class="w-12 h-12 bg-orange-200 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex-1 bg-orange-200 rounded-full h-2">
                            <div class="bg-orange-600 h-2 rounded-full" style="width: {{ ($daysOnTarget / 7) * 100 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 bg-gray-50">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                    Calorie Trends
                                </h3>
                                <p class="text-sm text-gray-600">Daily intake vs. your goal</p>
                            </div>
                            <div class="flex space-x-2">
                                <button class="px-3 py-1 text-sm bg-blue-100 text-blue-600 rounded-lg font-medium">Line</button>
                                <button class="px-3 py-1 text-sm bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200">Bar</button>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="h-80">
                            <canvas id="calorieChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 bg-gray-50">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                                    </svg>
                                    Macro Distribution
                                </h3>
                                <p class="text-sm text-gray-600">Weekly average breakdown</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        @if($avgDailyCalories > 0)
                            <div class="h-80 flex items-center justify-center">
                                <canvas id="macroChart" class="max-h-full"></canvas>
                            </div>
                            <div class="mt-6 grid grid-cols-3 gap-4">
                                <div class="text-center p-3 bg-red-50 rounded-lg">
                                    <div class="text-2xl font-bold text-red-600">{{ $macroPercentages['carbs'] }}%</div>
                                    <div class="text-sm text-red-700 font-medium">Carbs</div>
                                    <div class="text-xs text-red-500">{{ $avgCarbs }}g avg</div>
                                </div>
                                <div class="text-center p-3 bg-blue-50 rounded-lg">
                                    <div class="text-2xl font-bold text-blue-600">{{ $macroPercentages['protein'] }}%</div>
                                    <div class="text-sm text-blue-700 font-medium">Protein</div>
                                    <div class="text-xs text-blue-500">{{ $avgProtein }}g avg</div>
                                </div>
                                <div class="text-center p-3 bg-yellow-50 rounded-lg">
                                    <div class="text-2xl font-bold text-yellow-600">{{ $macroPercentages['fat'] }}%</div>
                                    <div class="text-sm text-yellow-700 font-medium">Fat</div>
                                    <div class="text-xs text-yellow-500">{{ $avgFat }}g avg</div>
                                </div>
                            </div>
                        @else
                            <div class="h-80 flex items-center justify-center">
                                <div class="text-center">
                                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">No Data Available</h3>
                                    <p class="text-gray-500 mb-4">Start tracking meals to see your macro distribution</p>
                                    <a href="{{ route('meals.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        Add Your First Meal
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            Daily Progress
                        </h3>
                        <p class="text-sm text-gray-600">Goal achievement by day</p>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @forelse($chartLabels as $index => $day)
                                @php $calories = $chartData[$index] ?? 0; @endphp
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-medium
                                        @if($goal && $goal->daily_calories)
                                            {{ $calories > $goal->daily_calories ? 'bg-red-100 text-red-600' : ($calories >= ($goal->daily_calories * 0.8) ? 'bg-green-100 text-green-600' : 'bg-yellow-100 text-yellow-600') }}
                                        @else
                                            bg-gray-100 text-gray-600
                                        @endif">
                                            {{ substr($day, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $day }}</div>
                                            <div class="text-xs text-gray-500">{{ $calories }} kcal</div>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <div class="w-16 bg-gray-200 rounded-full h-2">
                                            @if($goal && $goal->daily_calories)
                                                <div class="h-2 rounded-full {{ $calories > $goal->daily_calories ? 'bg-red-500' : ($calories >= ($goal->daily_calories * 0.8) ? 'bg-green-500' : 'bg-yellow-500') }}"
                                                     style="width: {{ min(100, ($calories / $goal->daily_calories) * 100) }}%"></div>
                                            @else
                                                <div class="h-2 rounded-full bg-gray-400" style="width: 50%"></div>
                                            @endif
                                        </div>
                                        <span class="text-xs font-medium
                                        @if($goal && $goal->daily_calories)
                                            {{ $calories > $goal->daily_calories ? 'text-red-600' : ($calories >= ($goal->daily_calories * 0.8) ? 'text-green-600' : 'text-yellow-600') }}
                                        @else
                                            text-gray-600
                                        @endif">
                                        {{ $goal && $goal->daily_calories ? round(($calories / $goal->daily_calories) * 100) : '--' }}%
                                    </span>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <p class="text-gray-500">No meal data available for this week</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>


                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                            Smart Insights
                        </h3>
                        <p class="text-sm text-gray-600">AI-powered recommendations</p>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @if($daysOnTarget > 0)
                                <div class="flex items-start space-x-3 p-3 bg-green-50 rounded-lg">
                                    <div class="w-6 h-6 bg-green-200 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-green-800">Great Consistency!</div>
                                        <div class="text-xs text-green-600 mt-1">You stayed within your goal on {{ $daysOnTarget }} out of 7 days</div>
                                    </div>
                                </div>
                            @endif

                            @if($maxCalories > 0)
                                <div class="flex items-start space-x-3 p-3 bg-blue-50 rounded-lg">
                                    <div class="w-6 h-6 bg-blue-200 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <svg class="w-3 h-3 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-blue-800">Peak Day Analysis</div>
                                        <div class="text-xs text-blue-600 mt-1">{{ $maxCaloriesDay }} was your highest intake day ({{ $maxCalories }} kcal)</div>
                                    </div>
                                </div>
                            @endif

                            <div class="flex items-start space-x-3 p-3 bg-purple-50 rounded-lg">
                                <div class="w-6 h-6 bg-purple-200 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <svg class="w-3 h-3 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-purple-800">Weekly Average</div>
                                    <div class="text-xs text-purple-600 mt-1">{{ $avgDailyCalories }} kcal daily average</div>
                                </div>
                            </div>

                            @if($weeklyMealsCount == 0)
                                <div class="flex items-start space-x-3 p-3 bg-yellow-50 rounded-lg">
                                    <div class="w-6 h-6 bg-yellow-200 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <svg class="w-3 h-3 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-yellow-800">Get Started</div>
                                        <div class="text-xs text-yellow-600 mt-1">Start tracking meals to see personalized insights</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                            </svg>
                            Goal Tracking
                        </h3>
                        <p class="text-sm text-gray-600">Progress towards targets</p>
                    </div>
                    <div class="p-6">
                        @if($goal)
                            <div class="space-y-6">

                                <div>
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="text-sm font-medium text-gray-700">Daily Calories</span>
                                        <span class="text-sm text-gray-500">{{ $avgDailyCalories }} / {{ $goal->daily_calories }}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-3">
                                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-3 rounded-full transition-all duration-500"
                                             style="width: {{ min(100, ($avgDailyCalories / $goal->daily_calories) * 100) }}%"></div>
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1">{{ round(($avgDailyCalories / $goal->daily_calories) * 100) }}% of goal</div>
                                </div>

                                @if($goal->daily_protein)
                                    <div>
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="text-sm font-medium text-gray-700">Daily Protein</span>
                                            <span class="text-sm text-gray-500">{{ $avgProtein }}g / {{ $goal->daily_protein }}g</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-3">
                                            <div class="bg-gradient-to-r from-green-500 to-green-600 h-3 rounded-full transition-all duration-500"
                                                 style="width: {{ min(100, ($avgProtein / $goal->daily_protein) * 100) }}%"></div>
                                        </div>
                                        <div class="text-xs text-gray-500 mt-1">{{ round(($avgProtein / $goal->daily_protein) * 100) }}% of goal</div>
                                    </div>
                                @endif

                                <div>
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="text-sm font-medium text-gray-700">Weekly Consistency</span>
                                        <span class="text-sm text-gray-500">{{ $daysOnTarget }}/7 days</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-3">
                                        <div class="bg-gradient-to-r from-purple-500 to-purple-600 h-3 rounded-full transition-all duration-500"
                                             style="width: {{ ($daysOnTarget / 7) * 100 }}%"></div>
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1">{{ round(($daysOnTarget / 7) * 100) }}% consistency</div>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-8">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-lg font-medium text-gray-900 mb-2">Set Your Goals</h4>
                                <p class="text-gray-500 mb-4">Define your nutrition goals to track progress</p>
                                <a href="{{ route('goals.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Set Goals
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gray-50">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2h2a2 2 0 002-2z"></path>
                                </svg>
                                Detailed Breakdown
                            </h3>
                            <p class="text-sm text-gray-600">Complete daily nutrition analysis</p>
                        </div>
                        <button class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                            Export Data
                        </button>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Day</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Calories</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Protein</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Carbs</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fat</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Goal Status</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($chartLabels as $index => $day)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="text-sm font-medium text-gray-900">{{ $day }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 font-medium">{{ $chartData[$index] ?? 0 }} kcal</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $weeklyProteinData[$index] ?? 0 }}g</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $weeklyCarbsData[$index] ?? 0 }}g</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $weeklyFatData[$index] ?? 0 }}g</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($goal && $goal->daily_calories)
                                        @php $calories = $chartData[$index] ?? 0; @endphp
                                        @if($calories <= $goal->daily_calories && $calories >= ($goal->daily_calories * 0.8))
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        On Target
                    </span>
                                        @elseif($calories > $goal->daily_calories)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                        Over Goal
                    </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        Under Goal
                    </span>
                                        @endif
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                    No Goal Set
                </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="text-gray-500">
                                        <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                        </svg>
                                        <p class="text-lg font-medium mb-2">No Data Available</p>
                                        <p class="mb-4">Start tracking meals to see detailed analytics</p>
                                        <a href="{{ route('meals.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                            Add Your First Meal
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chartLabels = @json($chartLabels);
            const chartData = @json($chartData);
            const calorieGoal = {{ $goal && $goal->daily_calories ? $goal->daily_calories : 2000 }};
            const macroPercentages = @json($macroPercentages);

            const ctx = document.getElementById('calorieChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: chartLabels,
                    datasets: [
                        {
                            label: 'Daily Calories',
                            data: chartData,
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            borderColor: 'rgba(59, 130, 246, 1)',
                            borderWidth: 3,
                            tension: 0.4,
                            fill: true,
                            pointBackgroundColor: 'rgba(59, 130, 246, 1)',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 3,
                            pointRadius: 6,
                            pointHoverRadius: 8,
                            pointHoverBackgroundColor: 'rgba(59, 130, 246, 1)',
                            pointHoverBorderColor: '#fff',
                            pointHoverBorderWidth: 3
                        },
                        {
                            label: 'Daily Goal',
                            data: Array(chartLabels.length).fill(calorieGoal),
                            borderColor: 'rgba(239, 68, 68, 1)',
                            backgroundColor: 'rgba(239, 68, 68, 0.1)',
                            borderWidth: 2,
                            borderDash: [8, 4],
                            pointRadius: 0,
                            fill: false
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                drawBorder: false,
                                color: 'rgba(0, 0, 0, 0.05)'
                            },
                            ticks: {
                                callback: function(value) {
                                    return value + ' kcal';
                                },
                                font: {
                                    size: 12
                                },
                                color: '#6B7280'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 12
                                },
                                color: '#6B7280'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleFont: {
                                size: 14,
                                weight: 'bold'
                            },
                            bodyFont: {
                                size: 12
                            },
                            cornerRadius: 8,
                            displayColors: true,
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.y !== null) {
                                        label += context.parsed.y + ' kcal';
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            });

            @if($avgDailyCalories > 0)
            const macroCtx = document.getElementById('macroChart').getContext('2d');
            new Chart(macroCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Carbohydrates', 'Protein', 'Fat'],
                    datasets: [{
                        data: [macroPercentages.carbs, macroPercentages.protein, macroPercentages.fat],
                        backgroundColor: [
                            'rgba(239, 68, 68, 0.8)',
                            'rgba(59, 130, 246, 0.8)',
                            'rgba(245, 158, 11, 0.8)'
                        ],
                        borderColor: [
                            'rgba(239, 68, 68, 1)',
                            'rgba(59, 130, 246, 1)',
                            'rgba(245, 158, 11, 1)'
                        ],
                        borderWidth: 2,
                        hoverOffset: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '60%',
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleFont: {
                                size: 14,
                                weight: 'bold'
                            },
                            bodyFont: {
                                size: 12
                            },
                            cornerRadius: 8,
                            callbacks: {
                                label: function(context) {
                                    return context.label + ': ' + context.parsed + '%';
                                }
                            }
                        }
                    }
                }
            });
            @endif
        });
    </script>
</x-app-layout>
