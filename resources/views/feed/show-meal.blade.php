<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    {{ $meal->name }}
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    A meal by {{ $meal->user->name }}
                </p>
            </div>
            <a href="{{ route('feed.index') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">
                &larr; Back to Feed
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if ($meal->image_path)
                        <img class="w-full h-96 object-cover rounded-lg mb-6" src="{{ asset('storage/' . $meal->image_path) }}" alt="{{ $meal->name }}">
                    @endif

                    <h3 class="text-2xl font-semibold mb-4">Nutritional Summary</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8 text-center">
                        <div class="bg-blue-50 p-4 rounded-lg shadow">
                            <div class="text-sm font-medium text-blue-600">Calories</div>
                            <div class="text-3xl font-bold text-blue-800">{{ round($total['calories']) }}</div>
                        </div>
                        <div class="bg-green-50 p-4 rounded-lg shadow">
                            <div class="text-sm font-medium text-green-600">Protein</div>
                            <div class="text-3xl font-bold text-green-800">{{ round($total['protein']) }}g</div>
                        </div>
                        <div class="bg-yellow-50 p-4 rounded-lg shadow">
                            <div class="text-sm font-medium text-yellow-600">Fat</div>
                            <div class="text-3xl font-bold text-yellow-800">{{ round($total['fat']) }}g</div>
                        </div>
                        <div class="bg-red-50 p-4 rounded-lg shadow">
                            <div class="text-sm font-medium text-red-600">Carbs</div>
                            <div class="text-3xl font-bold text-red-800">{{ round($total['carbs']) }}g</div>
                        </div>
                    </div>

                    <h3 class="text-2xl font-semibold mb-4">Ingredients</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ingredient</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($meal->ingredients as $ingredient)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $ingredient->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $ingredient->pivot->quantity }} {{ $units[$ingredient->pivot->unit_id]->abbreviation }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
