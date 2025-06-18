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
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg shadow" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
                <div class="mb-4 sm:mb-0">
                    <h3 class="text-2xl font-bold text-gray-800">Your Meals</h3>
                    <p class="text-sm text-gray-500">A collection of all the meals you've tracked.</p>
                </div>
                <a href="{{ route('meals.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shrink-0">
                    Add New Meal
                </a>
            </div>


            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                @forelse ($meals as $meal)
                    <a href="{{ route('meals.show', $meal) }}" class="group block bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 ease-in-out transform hover:-translate-y-1">
                        <div class="relative">
                            @if ($meal->image_path)
                                <img class="w-full h-56 object-cover rounded-t-xl" src="{{ asset('storage/' . $meal->image_path) }}" alt="{{ $meal->name }}">
                            @else
                                <div class="w-full h-56 bg-gray-100 rounded-t-xl flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 19v-1.5a2.5 2.5 0 012.5-2.5h13A2.5 2.5 0 0121 17.5V19m-18 0a2.5 2.5 0 002.5 2.5h13A2.5 2.5 0 0021 19m-18 0h18M9 12a4 4 0 100-8 4 4 0 000 8z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-t-xl"></div>
                        </div>

                        <div class="p-5">
                            <h4 class="font-bold text-xl text-gray-800 truncate">{{ $meal->name }}</h4>
                            <p class="text-sm text-gray-500 mt-1">{{ $meal->created_at->format('F j, Y') }}</p>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full bg-white rounded-lg shadow-md text-center py-16">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 19v-1.5a2.5 2.5 0 012.5-2.5h13A2.5 2.5 0 0121 17.5V19m-18 0a2.5 2.5 0 002.5 2.5h13A2.5 2.5 0 0021 19m-18 0h18M9 12a4 4 0 100-8 4 4 0 000 8z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">No Meals Yet</h3>
                        <p class="mt-1 text-sm text-gray-500">Get started by adding your first meal.</p>
                        <div class="mt-6">
                            <a href="{{ route('meals.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                Add a Meal
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
