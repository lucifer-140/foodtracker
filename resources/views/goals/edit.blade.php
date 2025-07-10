<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Set Your Goals</h2>
                <p class="mt-1 text-sm text-gray-500">Set your daily nutritional targets to track your progress.</p>
            </div>
            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg shadow" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-lg border border-gray-100">
                <form method="POST" action="{{ route('goals.update') }}" class="p-6 space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="daily_calories" value="Daily Calories (kcal)" />
                        <x-text-input id="daily_calories" name="daily_calories" type="number" class="mt-1 block w-full" :value="old('daily_calories', $goal->daily_calories)" />
                    </div>

                    <div>
                        <x-input-label for="daily_protein" value="Daily Protein (g)" />
                        <x-text-input id="daily_protein" name="daily_protein" type="number" class="mt-1 block w-full" :value="old('daily_protein', $goal->daily_protein)" />
                    </div>

                    <div>
                        <x-input-label for="daily_fat" value="Daily Fat (g)" />
                        <x-text-input id="daily_fat" name="daily_fat" type="number" class="mt-1 block w-full" :value="old('daily_fat', $goal->daily_fat)" />
                    </div>

                    <div>
                        <x-input-label for="daily_carbs" value="Daily Carbs (g)" />
                        <x-text-input id="daily_carbs" name="daily_carbs" type="number" class="mt-1 block w-full" :value="old('daily_carbs', $goal->daily_carbs)" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save Goals') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
