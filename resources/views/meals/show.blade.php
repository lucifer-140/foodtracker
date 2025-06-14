<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $meal->name }}
            </h2>

            <div class="flex items-center space-x-4">
                <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">
                    &larr; Back to Dashboard
                </a>

                <a href="{{ route('meals.edit', $meal) }}" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600">Edit</a>

                <form method="POST" action="{{ route('meals.destroy', $meal) }}" onsubmit="return confirm('Are you sure you want to delete this meal?');">
                    @csrf
                    @method('DELETE')
                    <x-danger-button type="submit">
                        Delete
                    </x-danger-button>
                </form>
            </div>
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
