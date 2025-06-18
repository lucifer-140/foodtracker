<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Meal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="POST" action="{{ route('meals.update', $meal) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900">Live Nutritional Summary</h3>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-2 text-center">
                                <div class="bg-blue-50 p-3 rounded-lg shadow-sm">
                                    <div class="text-sm font-medium text-blue-600">Calories</div>
                                    <div id="total-calories" class="text-2xl font-bold text-blue-800">{{ round($total['calories']) }}</div>
                                </div>
                                <div class="bg-green-50 p-3 rounded-lg shadow-sm">
                                    <div class="text-sm font-medium text-green-600">Protein</div>
                                    <div id="total-protein" class="text-2xl font-bold text-green-800">{{ round($total['protein']) }}g</div>
                                </div>
                                <div class="bg-yellow-50 p-3 rounded-lg shadow-sm">
                                    <div class="text-sm font-medium text-yellow-600">Fat</div>
                                    <div id="total-fat" class="text-2xl font-bold text-yellow-800">{{ round($total['fat']) }}g</div>
                                </div>
                                <div class="bg-red-50 p-3 rounded-lg shadow-sm">
                                    <div class="text-sm font-medium text-red-600">Carbs</div>
                                    <div id="total-carbs" class="text-2xl font-bold text-red-800">{{ round($total['carbs']) }}g</div>
                                </div>
                            </div>
                        </div>
                        <hr class="mb-6">

                        <div>
                            <x-input-label for="name" :value="__('Meal Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $meal->name)" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="image" :value="__('Change Meal Image (Optional)')" />
                            @if ($meal->image_path)
                                <div class="my-2">
                                    <img src="{{ asset('storage/' . $meal->image_path) }}" alt="{{ $meal->name }}" class="w-40 h-40 object-cover rounded-md">
                                </div>
                            @endif
                            <x-text-input id="image" class="block mt-1 w-full" type="file" name="image" />
                        </div>

                        <div class="mt-6">
                            <h3 class="text-lg font-medium text-gray-900">Ingredients</h3>
                            <div id="ingredients-container" class="mt-4 space-y-4">
                                @foreach ($meal->ingredients as $index => $existingIngredient)
                                    <div class="flex items-center space-x-3" data-ingredient-row="{{ $index }}">
                                        {{-- Ingredient Dropdown --}}
                                        <div class="w-5/12">
                                            <div class="relative group">
                                                <input type="hidden" name="ingredients[{{ $index }}][id]" value="{{ $existingIngredient->id }}" required>
                                                <button type="button" class="dropdown-button inline-flex justify-between w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500">
                                                    <span class="dropdown-label mr-2">{{ $existingIngredient->name }}</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                                </button>
                                                <div class="dropdown-menu hidden absolute z-10 w-full mt-2 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 p-1 space-y-1">
                                                    <input class="search-input block w-full px-4 py-2 text-gray-800 border rounded-md border-gray-300 focus:outline-none" type="text" placeholder="Search..." autocomplete="off">
                                                    <div class="dropdown-options max-h-48 overflow-y-auto">
                                                        @foreach ($ingredients as $ingredient)
                                                            <a href="#" class="option-item block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md" data-value="{{ $ingredient->id }}" data-text="{{ $ingredient->name }}">{{ $ingredient->name }}</a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Quantity Input --}}
                                        <div class="w-3/12">
                                            <input type="number" name="ingredients[{{ $index }}][quantity]" placeholder="Quantity" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" value="{{ $existingIngredient->pivot->quantity }}" required min="1">
                                        </div>

                                        {{-- Unit Select --}}
                                        <div class="w-3/12">
                                            <select name="ingredients[{{ $index }}][unit_id]" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                                                @foreach($units as $unit)
                                                    <option value="{{ $unit->id }}" @selected($unit->id == $existingIngredient->pivot->unit_id)>
                                                        {{ $unit->abbreviation }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- Remove Button --}}
                                        <div class="w-1/12">
                                            <button type="button" class="remove-btn inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">X</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-4">
                                <x-secondary-button type="button" onclick="addIngredientRow()">
                                    {{ __('Add Another Ingredient') }}
                                </x-secondary-button>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                {{ __('Update Meal') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // 1. Make the ingredients data from the controller available to our script
        const allIngredients = @json($ingredientsJson);
        const allUnits = @json($unitsJson);

        const ingredientsContainer = document.getElementById('ingredients-container');
        let ingredientIndex = {{ $meal->ingredients->count() }};

        // 2. The calculation function
        function updateTotals() {
            let totals = { calories: 0, protein: 0, fat: 0, carbs: 0 };
            const ingredientRows = ingredientsContainer.querySelectorAll('[data-ingredient-row]');

            ingredientRows.forEach(row => {
                const hiddenInput = row.querySelector('input[type="hidden"]');
                const quantityInput = row.querySelector('input[type="number"]');
                const unitSelect = row.querySelector('select[name*="[unit_id]"]');

                const ingredientId = hiddenInput.value;
                const unitId = unitSelect.value;
                const quantity = parseFloat(quantityInput.value) || 0;

                if (ingredientId && unitId && quantity > 0 && allIngredients[ingredientId] && allUnits[unitId]) {
                    const ingredientData = allIngredients[ingredientId];
                    const unitData = allUnits[unitId];
                    const conversionFactor = parseFloat(unitData.conversion_factor);
                    const quantityInGrams = quantity * conversionFactor;

                    totals.calories += (ingredientData.calories_per_100g / 100) * quantityInGrams;
                    totals.protein  += (ingredientData.protein_per_100g / 100) * quantityInGrams;
                    totals.fat      += (ingredientData.fat_per_100g / 100) * quantityInGrams;
                    totals.carbs    += (ingredientData.carbs_per_100g / 100) * quantityInGrams;
                }
            });

            document.getElementById('total-calories').textContent = Math.round(totals.calories);
            document.getElementById('total-protein').textContent = Math.round(totals.protein) + 'g';
            document.getElementById('total-fat').textContent = Math.round(totals.fat) + 'g';
            document.getElementById('total-carbs').textContent = Math.round(totals.carbs) + 'g';
        }

        // 3. The `addIngredientRow` function with the corrected button
        function addIngredientRow() {
            const index = ingredientIndex++;
            const newRow = document.createElement('div');
            newRow.classList.add('flex', 'items-center', 'space-x-3');
            newRow.setAttribute('data-ingredient-row', index);
            newRow.innerHTML = `
            <div class="w-5/12"><div class="relative group"><input type="hidden" name="ingredients[${index}][id]" required><button type="button" class="dropdown-button inline-flex justify-between w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500"><span class="dropdown-label mr-2">Select Ingredient</span><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" /></svg></button><div class="dropdown-menu hidden absolute z-10 w-full mt-2 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 p-1 space-y-1"><input class="search-input block w-full px-4 py-2 text-gray-800 border rounded-md border-gray-300 focus:outline-none" type="text" placeholder="Search..." autocomplete="off"><div class="dropdown-options max-h-48 overflow-y-auto">@foreach ($ingredients as $ingredient)<a href="#" class="option-item block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md" data-value="{{ $ingredient->id }}" data-text="{{ $ingredient->name }}">{{ $ingredient->name }}</a>@endforeach</div></div></div></div>
            <div class="w-3/12"><input type="number" name="ingredients[${index}][quantity]" placeholder="Quantity" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required min="1"></div>
            <div class="w-3/12"><select name="ingredients[${index}][unit_id]" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>@foreach($units as $unit)<option value="{{ $unit->id }}">{{ $unit->abbreviation }}</option>@endforeach</select></div>
            <div class="w-1/12"><button type="button" class="remove-btn inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">X</button></div>
        `;
            ingredientsContainer.appendChild(newRow);
            initializeDropdown(newRow);
        }

        // 4. The `initializeDropdown` function with the corrected selector
        function initializeDropdown(context) {
            const dropdownButton = context.querySelector('.dropdown-button');
            const dropdownMenu = context.querySelector('.dropdown-menu');
            const searchInput = context.querySelector('.search-input');
            const options = context.querySelectorAll('.option-item');
            const hiddenInput = context.querySelector('input[type="hidden"]');
            const dropdownLabel = context.querySelector('.dropdown-label');
            const removeBtn = context.querySelector('.remove-btn'); // Correct selector

            dropdownButton.addEventListener('click', (e) => { e.stopPropagation(); dropdownMenu.classList.toggle('hidden'); });

            options.forEach(option => {
                option.addEventListener('click', (e) => {
                    e.preventDefault();
                    hiddenInput.value = option.getAttribute('data-value');
                    dropdownLabel.textContent = option.getAttribute('data-text');
                    dropdownMenu.classList.add('hidden');
                    hiddenInput.dispatchEvent(new Event('change', { bubbles: true }));
                });
            });

            searchInput.addEventListener('input', () => {
                const searchTerm = searchInput.value.toLowerCase();
                options.forEach(option => {
                    option.style.display = option.textContent.toLowerCase().includes(searchTerm) ? 'block' : 'none';
                });
            });

            // This listener will now work correctly
            removeBtn.addEventListener('click', () => {
                context.remove();
                updateTotals();
            });
        }

        // 5. The Event Listeners
        ingredientsContainer.addEventListener('input', (e) => {
            if (e.target.matches('input[type="number"]')) {
                updateTotals();
            }
        });
        ingredientsContainer.addEventListener('change', (e) => {
            if (e.target.matches('input[type="hidden"], select[name*="[unit_id]"]')) {
                updateTotals();
            }
        });

        // 6. Initialize the page on load
        document.addEventListener('DOMContentLoaded', () => {
            const existingRows = document.querySelectorAll('[data-ingredient-row]');
            existingRows.forEach(row => {
                initializeDropdown(row);
            });
            updateTotals();
        });

        // Global click listener to close dropdowns
        document.addEventListener('click', (e) => {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                if (!menu.contains(e.target) && !menu.previousElementSibling.contains(e.target)) {
                    menu.classList.add('hidden');
                }
            });
        });
    </script>
</x-app-layout>
