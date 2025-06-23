<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">Set Your Goals</h2>
        <p class="mt-1 text-sm text-gray-500">Set your daily nutritional targets to track your progress.</p>
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
