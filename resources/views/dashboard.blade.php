<x-app-layout>
    <x-slot name="header">
        <div class="mb-4 sm:mb-0">
            <h2 class="text-2xl font-bold text-gray-800">
                {{ __('Dashboard') }}
            </h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Stay on track with your health and nutrition goals.
            </p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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

            <!-- Welcome Section with Quick Stats -->
            <div class="mb-8 bg-gradient-to-r from-green-50 to-blue-50 rounded-2xl p-6 border border-green-100">
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center">
                    <div class="mb-4 lg:mb-0">
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">
                            Welcome back, {{ Auth::user()->name }}! 👋
                        </h3>
                        <p class="text-gray-600">Here's your nutrition overview for today</p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <div class="text-center bg-white rounded-lg px-4 py-3 shadow-sm border">
                            <div class="text-2xl font-bold text-green-600">{{ $meals->count() }}</div>
                            <div class="text-sm text-gray-500">Total Meals</div>
                        </div>
                        <div class="text-center bg-white rounded-lg px-4 py-3 shadow-sm border">
                            <div class="text-2xl font-bold text-blue-600">{{ $meals->where('created_at', '>=', today())->count() }}</div>
                            <div class="text-sm text-gray-500">Today's Meals</div>
                        </div>
                        <div class="text-center bg-white rounded-lg px-4 py-3 shadow-sm border">
                            <div class="text-2xl font-bold text-purple-600">{{ $meals->where('created_at', '>=', now()->startOfWeek())->count() }}</div>
                            <div class="text-sm text-gray-500">This Week</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <a href="{{ route('meals.create') }}" class="group bg-white rounded-xl p-6 shadow-md hover:shadow-lg transition-all duration-300 border border-gray-100 hover:border-green-200 transform hover:-translate-y-1">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center group-hover:bg-green-200 transition-colors">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-sm font-semibold text-gray-800">Add Meal</h4>
                                <p class="text-xs text-gray-500">Log a new meal</p>
                            </div>
                        </div>
                    </a>

                    <a href="#" class="group bg-white rounded-xl p-6 shadow-md hover:shadow-lg transition-all duration-300 border border-gray-100 hover:border-blue-200 transform hover:-translate-y-1">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-200 transition-colors">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-sm font-semibold text-gray-800">View Reports</h4>
                                <p class="text-xs text-gray-500">Nutrition insights</p>
                            </div>
                        </div>
                    </a>

                    <a href="#" class="group bg-white rounded-xl p-6 shadow-md hover:shadow-lg transition-all duration-300 border border-gray-100 hover:border-purple-200 transform hover:-translate-y-1">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center group-hover:bg-purple-200 transition-colors">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-sm font-semibold text-gray-800">Set Goals</h4>
                                <p class="text-xs text-gray-500">Nutrition targets</p>
                            </div>
                        </div>
                    </a>

                    <a href="#" class="group bg-white rounded-xl p-6 shadow-md hover:shadow-lg transition-all duration-300 border border-gray-100 hover:border-orange-200 transform hover:-translate-y-1">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center group-hover:bg-orange-200 transition-colors">
                                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-sm font-semibold text-gray-800">Meal History</h4>
                                <p class="text-xs text-gray-500">View all meals</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Recent Activity & Meals Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                <!-- Recent Activity -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            Recent Activity
                        </h3>
                        <div class="space-y-4">
                            @forelse ($meals->take(3) as $meal)
                                <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                    <div class="flex-shrink-0">
                                        @if ($meal->image_path)
                                            <img class="w-10 h-10 rounded-lg object-cover" src="{{ asset('storage/' . $meal->image_path) }}" alt="{{ $meal->name }}">
                                        @else
                                            <div class="w-10 h-10 bg-gray-200 rounded-lg flex items-center justify-center">
                                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-1.5a2.5 2.5 0 012.5-2.5h13A2.5 2.5 0 0121 17.5V19"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-800 truncate">{{ $meal->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $meal->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-4">
                                    <p class="text-sm text-gray-500">No recent activity</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Today's Progress -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            Today's Progress
                        </h3>

                        @php
                            $todaysMeals = $meals->where('created_at', '>=', today())->count();
                            $weeklyGoal = 21; // 3 meals per day * 7 days
                            $dailyGoal = 3;
                            $progressPercentage = $todaysMeals > 0 ? min(($todaysMeals / $dailyGoal) * 100, 100) : 0;
                        @endphp

                        <div class="space-y-6">
                            <!-- Daily Goal Progress -->
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-sm font-medium text-gray-700">Daily Meals Goal</span>
                                    <span class="text-sm text-gray-500">{{ $todaysMeals }}/{{ $dailyGoal }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-3">
                                    <div class="bg-gradient-to-r from-green-400 to-green-600 h-3 rounded-full transition-all duration-500 ease-out" style="width: {{ $progressPercentage }}%"></div>
                                </div>
                            </div>

                            <!-- Weekly Streak -->
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-sm font-medium text-gray-700">Weekly Streak</span>
                                    <span class="text-sm text-gray-500">{{ $meals->where('created_at', '>=', now()->startOfWeek())->count() }} meals this week</span>
                                </div>
                                <div class="grid grid-cols-7 gap-1">
                                    @for ($i = 0; $i < 7; $i++)
                                        @php
                                            $day = now()->startOfWeek()->addDays($i);
                                            $dayMeals = $meals->where('created_at', '>=', $day->startOfDay())->where('created_at', '<=', $day->endOfDay())->count();
                                        @endphp
                                        <div class="text-center">
                                            <div class="text-xs text-gray-500 mb-1">{{ $day->format('D') }}</div>
                                            <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-medium
                                                {{ $dayMeals > 0 ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-400' }}
                                                {{ $day->isToday() ? 'ring-2 ring-green-400' : '' }}">
                                                {{ $dayMeals }}
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Meals Section -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
                <div class="mb-4 sm:mb-0">
                    <h3 class="text-2xl font-bold text-gray-800 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-1.5a2.5 2.5 0 012.5-2.5h13A2.5 2.5 0 0121 17.5V19"></path>
                        </svg>
                        Your Meals
                    </h3>
                    <p class="text-sm text-gray-500">A collection of all the meals you've tracked.</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('meals.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-150 transform hover:scale-105 shadow-md hover:shadow-lg">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add New Meal
                    </a>
                </div>
            </div>

            <!-- Meals Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse ($meals as $meal)
                    <a href="{{ route('meals.show', $meal) }}" class="group block bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 ease-in-out transform hover:-translate-y-2 border border-gray-100 hover:border-green-200">
                        <div class="relative overflow-hidden">
                            @if ($meal->image_path)
                                <img class="w-full h-48 object-cover rounded-t-xl group-hover:scale-105 transition-transform duration-300" src="{{ asset('storage/' . $meal->image_path) }}" alt="{{ $meal->name }}">
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-gray-100 to-gray-200 rounded-t-xl flex items-center justify-center group-hover:from-gray-200 group-hover:to-gray-300 transition-all duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 group-hover:text-gray-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 19v-1.5a2.5 2.5 0 012.5-2.5h13A2.5 2.5 0 0121 17.5V19m-18 0a2.5 2.5 0 002.5 2.5h13A2.5 2.5 0 0021 19m-18 0h18M9 12a4 4 0 100-8 4 4 0 000 8z" />
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-t-xl"></div>

                            <!-- Meal Time Badge -->
                            <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm rounded-full px-3 py-1 text-xs font-medium text-gray-700">
                                {{ $meal->created_at->format('g:i A') }}
                            </div>
                        </div>

                        <div class="p-5">
                            <h4 class="font-bold text-lg text-gray-800 truncate group-hover:text-green-600 transition-colors">{{ $meal->name }}</h4>
                            <div class="flex items-center justify-between mt-2">
                                <p class="text-sm text-gray-500">{{ $meal->created_at->format('M j, Y') }}</p>
                                <div class="flex items-center text-xs text-gray-400">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    View Details
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full bg-white rounded-xl shadow-md text-center py-16 border border-gray-100">
                        <div class="max-w-sm mx-auto">
                            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 19v-1.5a2.5 2.5 0 012.5-2.5h13A2.5 2.5 0 0121 17.5V19m-18 0a2.5 2.5 0 002.5 2.5h13A2.5 2.5 0 0021 19m-18 0h18M9 12a4 4 0 100-8 4 4 0 000 8z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">No Meals Yet</h3>
                            <p class="text-gray-500 mb-6">Start your nutrition journey by adding your first meal.</p>
                            <a href="{{ route('meals.create') }}" class="inline-flex items-center px-6 py-3 bg-green-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-green-700 transition-all duration-150 transform hover:scale-105 shadow-md hover:shadow-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Add Your First Meal
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination if needed -->
            @if($meals instanceof \Illuminate\Pagination\LengthAwarePaginator && $meals->hasPages())
                <div class="mt-8">
                    {{ $meals->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
