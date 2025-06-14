<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add a New Meal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="POST" action="{{ route('meals.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <x-input-label for="name" :value="__('Meal Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="image" :value="__('Meal Image (Optional)')" />
                            <x-text-input id="image" class="block mt-1 w-full" type="file" name="image" />
                        </div>

                        <div class="mt-6">
                            <h3 class="text-lg font-medium text-gray-900">Ingredients</h3>
                            <div id="ingredients-container" class="mt-4 space-y-4">
                            </div>
                            <div class="mt-4">
                                <x-secondary-button type="button" onclick="addIngredientRow()">
                                    {{ __('Add Ingredient') }}
                                </x-secondary-button>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                {{ __('Save Meal') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const ingredientsContainer = document.getElementById('ingredients-container');
        let ingredientIndex = 0;

        function addIngredientRow() {
            const index = ingredientIndex++;
            const newRow = document.createElement('div');
            newRow.classList.add('flex', 'items-center', 'space-x-3');
            newRow.setAttribute('data-ingredient-row', index);

            // This is the HTML structure for a single ingredient row, including our custom dropdown
            newRow.innerHTML = `
                {{-- Ingredient Dropdown --}}
            <div class="w-5/12">
                <div class="relative group">
                    <input type="hidden" name="ingredients[${index}][id]" required>
                        <button type="button" class="dropdown-button inline-flex justify-between w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500">
                            <span class="dropdown-label mr-2">Select Ingredient</span>
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
                <input type="number" name="ingredients[${index}][quantity]" placeholder="Quantity" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required min="1">
                </div>

                {{-- Unit Select --}}
            <div class="w-3/12">
                <select name="ingredients[${index}][unit_id]" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                        @foreach($units as $unit)
            <option value="{{ $unit->id }}">{{ $unit->abbreviation }}</option>
                        @endforeach
            </select>
        </div>

{{-- Remove Button --}}
            <div class="w-1/12">
                <x-danger-button type="button" onclick="this.closest('[data-ingredient-row]').remove()">X</x-danger-button>
            </div>
`;

            ingredientsContainer.appendChild(newRow);
            // Initialize the JavaScript for the dropdown we just created
            initializeDropdown(newRow);
        }

        // This function sets up all the event listeners for a single dropdown component
        function initializeDropdown(context) {
            const dropdownButton = context.querySelector('.dropdown-button');
            const dropdownMenu = context.querySelector('.dropdown-menu');
            const searchInput = context.querySelector('.search-input');
            const options = context.querySelectorAll('.option-item');
            const hiddenInput = context.querySelector('input[type="hidden"]');
            const dropdownLabel = context.querySelector('.dropdown-label');

            // Toggle dropdown visibility
            dropdownButton.addEventListener('click', (e) => {
                e.stopPropagation();
                dropdownMenu.classList.toggle('hidden');
            });

            // Handle clicking an option
            options.forEach(option => {
                option.addEventListener('click', (e) => {
                    e.preventDefault();
                    hiddenInput.value = option.getAttribute('data-value');
                    dropdownLabel.textContent = option.getAttribute('data-text');
                    dropdownMenu.classList.add('hidden');
                });
            });

            // Handle searching/filtering
            searchInput.addEventListener('input', () => {
                const searchTerm = searchInput.value.toLowerCase();
                options.forEach(option => {
                    const text = option.textContent.toLowerCase();
                    option.style.display = text.includes(searchTerm) ? 'block' : 'none';
                });
            });
        }

        // Close dropdowns if clicking outside
        document.addEventListener('click', (e) => {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                if (!menu.contains(e.target) && !menu.previousElementSibling.contains(e.target)) {
                    menu.classList.add('hidden');
                }
            });
        });

        // Automatically add the first ingredient row when the page loads
        document.addEventListener('DOMContentLoaded', () => {
            addIngredientRow();
        });
    </script>
</x-app-layout>
