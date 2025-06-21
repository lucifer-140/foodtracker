<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight flex items-center">
                    <svg class="w-6 h-6 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    {{ __('Add a New Meal') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">Create a detailed record of your meal with nutritional information</p>
            </div>
            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
{{--            <div class="mb-8">--}}
{{--                <div class="flex items-center justify-center space-x-4">--}}
{{--                    <div class="flex items-center">--}}
{{--                        <div class="flex items-center justify-center w-8 h-8 bg-green-600 text-white rounded-full text-sm font-medium">1</div>--}}
{{--                        <span class="ml-2 text-sm font-medium text-green-600">Meal Details</span>--}}
{{--                    </div>--}}
{{--                    <div class="w-16 h-1 bg-gray-200 rounded"></div>--}}
{{--                    <div class="flex items-center">--}}
{{--                        <div class="flex items-center justify-center w-8 h-8 bg-gray-200 text-gray-600 rounded-full text-sm font-medium">2</div>--}}
{{--                        <span class="ml-2 text-sm font-medium text-gray-500">Ingredients</span>--}}
{{--                    </div>--}}
{{--                    <div class="w-16 h-1 bg-gray-200 rounded"></div>--}}
{{--                    <div class="flex items-center">--}}
{{--                        <div class="flex items-center justify-center w-8 h-8 bg-gray-200 text-gray-600 rounded-full text-sm font-medium">3</div>--}}
{{--                        <span class="ml-2 text-sm font-medium text-gray-500">Review</span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

            <form method="POST" action="{{ route('meals.store') }}" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <div class="bg-gradient-to-r from-green-50 to-blue-50 rounded-2xl p-6 border border-green-100 shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            Live Nutritional Summary
                        </h3>
                        <div class="text-xs text-gray-500 bg-white/60 px-3 py-1 rounded-full">Updates automatically</div>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="bg-white/80 backdrop-blur-sm p-4 rounded-xl shadow-sm border border-white/50 text-center transform hover:scale-105 transition-transform">
                            <div class="text-sm font-medium text-blue-600 mb-1">Calories</div>
                            <div id="total-calories" class="text-2xl font-bold text-blue-800">0</div>
                            <div class="text-xs text-blue-500 mt-1">kcal</div>
                        </div>
                        <div class="bg-white/80 backdrop-blur-sm p-4 rounded-xl shadow-sm border border-white/50 text-center transform hover:scale-105 transition-transform">
                            <div class="text-sm font-medium text-green-600 mb-1">Protein</div>
                            <div id="total-protein" class="text-2xl font-bold text-green-800">0g</div>
                            <div class="text-xs text-green-500 mt-1">grams</div>
                        </div>
                        <div class="bg-white/80 backdrop-blur-sm p-4 rounded-xl shadow-sm border border-white/50 text-center transform hover:scale-105 transition-transform">
                            <div class="text-sm font-medium text-yellow-600 mb-1">Fat</div>
                            <div id="total-fat" class="text-2xl font-bold text-yellow-800">0g</div>
                            <div class="text-xs text-yellow-500 mt-1">grams</div>
                        </div>
                        <div class="bg-white/80 backdrop-blur-sm p-4 rounded-xl shadow-sm border border-white/50 text-center transform hover:scale-105 transition-transform">
                            <div class="text-sm font-medium text-red-600 mb-1">Carbs</div>
                            <div id="total-carbs" class="text-2xl font-bold text-red-800">0g</div>
                            <div class="text-xs text-red-500 mt-1">grams</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            Meal Information
                        </h3>
                        <p class="text-sm text-gray-600 mt-1">Basic details about your meal</p>
                    </div>

                    <div class="p-6 space-y-6">
                        <div>
                            <x-input-label for="name" :value="__('Meal Name')" class="text-sm font-medium text-gray-700 mb-2" />
                            <x-text-input id="name" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors" type="text" name="name" :value="old('name')" placeholder="e.g., Grilled Chicken Salad, Breakfast Smoothie..." required autofocus />
                        </div>

                        <div>
                            <x-input-label for="image" :value="__('Meal Image (Optional)')" class="text-sm font-medium text-gray-700 mb-2" />
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-green-400 transition-colors" id="image-dropzone">
                                <div class="space-y-1 text-center" id="image-placeholder">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48"><path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /></svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-green-600 hover:text-green-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-green-500">
                                            <span>Upload a photo</span>
                                            <input id="image" name="image" type="file" class="sr-only" accept="image/*" />
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                                </div>
                                <img id="image-preview" src="#" alt="Image Preview" class="hidden mx-auto h-32 object-cover rounded-md">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg border border-gray-100">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                    Ingredients
                                </h3>
                                <p class="text-sm text-gray-600 mt-1">Add ingredients to calculate nutrition</p>
                            </div>
                            <button type="button" onclick="addIngredientRow()" class="add-ingredient-btn inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm hover:shadow-md transform hover:scale-105">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                Add Ingredient
                            </button>
                        </div>
                    </div>

                    <div class="p-6">
                        <div id="ingredients-container" class="space-y-4">
                        </div>

                        <div id="empty-state" class="text-center py-12 hidden">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            </div>
                            <h4 class="text-lg font-medium text-gray-900 mb-2">No ingredients added yet</h4>
                            <p class="text-gray-500 mb-4">Click the button above to start building your meal</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end pt-6 space-x-3">
                    <a href="{{ route('dashboard') }}" class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition-colors">
                        Cancel
                    </a>
                    <x-primary-button class="px-8 py-3 bg-green-600 hover:bg-green-700 text-sm font-medium rounded-lg transition-all duration-200 shadow-md hover:shadow-lg transform hover:scale-105">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        {{ __('Save Meal') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // --- DATA FROM CONTROLLER ---
        const allIngredients = @json($ingredientsJson);
        const allUnits = @json($unitsJson);

        // --- ELEMENT REFERENCES ---
        const ingredientsContainer = document.getElementById('ingredients-container');
        const emptyState = document.getElementById('empty-state');
        const imageInput = document.getElementById('image');
        const imagePlaceholder = document.getElementById('image-placeholder');
        const imagePreview = document.getElementById('image-preview');
        let ingredientIndex = 0;

        // --- CORE FUNCTIONS ---

        // Animate the numbers in the summary for a nice visual effect
        function animateNumber(elementId, newValue, suffix = '') {
            const element = document.getElementById(elementId);
            if (!element) return;
            const currentValue = parseInt(element.textContent) || 0;
            if (currentValue === newValue) return;

            const duration = 300; // ms
            const steps = 15;
            const increment = (newValue - currentValue) / steps;
            let current = currentValue;

            const timer = setInterval(() => {
                current += increment;
                if ((increment > 0 && current >= newValue) || (increment < 0 && current <= newValue)) {
                    current = newValue;
                    clearInterval(timer);
                }
                element.textContent = Math.round(current) + suffix;
            }, duration / steps);
        }

        // Calculate totals from all ingredient rows
        function updateTotals() {
            let totals = { calories: 0, protein: 0, fat: 0, carbs: 0 };
            const ingredientRows = ingredientsContainer.querySelectorAll('.ingredient-row');

            ingredientRows.forEach(row => {
                const hiddenInput = row.querySelector('input[type="hidden"]');
                const quantityInput = row.querySelector('input[type="number"]');
                const unitSelect = row.querySelector('select');

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

            animateNumber('total-calories', totals.calories);
            animateNumber('total-protein', totals.protein, 'g');
            animateNumber('total-fat', totals.fat, 'g');
            animateNumber('total-carbs', totals.carbs, 'g');
        }

        // Show or hide the "No ingredients" message
        function toggleEmptyState() {
            const hasIngredients = ingredientsContainer.children.length > 0;
            emptyState.classList.toggle('hidden', hasIngredients);
        }

        // Add a new ingredient row to the container
        function addIngredientRow() {
            const index = ingredientIndex++;
            const newRow = document.createElement('div');
            newRow.classList.add('ingredient-row', 'bg-gray-50', 'rounded-xl', 'p-4', 'border', 'border-gray-200');
            newRow.style.opacity = '0';
            newRow.style.transform = 'translateY(10px)';
            newRow.setAttribute('data-ingredient-row', index);

            // This is the complete HTML for your new ingredient row design
            newRow.innerHTML = `
            <div class="flex items-end space-x-4">
                <div class="flex-1">
                    <label class="block text-xs font-medium text-gray-700 mb-1">Ingredient</label>
                    <div class="relative group">
                        <input type="hidden" name="ingredients[${index}][id]" required>
                        <button type="button" class="dropdown-button w-full inline-flex justify-between items-center px-4 py-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors">
                            <span class="dropdown-label text-gray-500">Select Ingredient</span>
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div class="dropdown-menu hidden absolute z-20 w-full mt-1 bg-white rounded-lg shadow-lg border border-gray-200 max-h-60 overflow-hidden">
                            <div class="p-2 border-b border-gray-100"><input class="search-input w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500" type="text" placeholder="Search ingredients..." autocomplete="off"></div>
                            <div class="dropdown-options max-h-48 overflow-y-auto p-1">
                                @foreach ($ingredients as $ingredient)
            <a href="#" class="option-item block px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-800 rounded-md transition-colors" data-value="{{ $ingredient->id }}" data-text="{{ $ingredient->name }}">{{ $ingredient->name }}</a>
                                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="w-24">
    <label class="block text-xs font-medium text-gray-700 mb-1">Quantity</label>
    <input type="number" name="ingredients[${index}][quantity]" placeholder="0" class="w-full px-3 py-3 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors" required min="0.1" step="0.1">
                </div>
                <div class="w-24">
                    <label class="block text-xs font-medium text-gray-700 mb-1">Unit</label>
                    <select name="ingredients[${index}][unit_id]" class="w-full px-3 py-3 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors" required>
                        @foreach($units as $unit)
            <option value="{{ $unit->id }}">{{ $unit->abbreviation }}</option>
                        @endforeach
            </select>
        </div>
        <div class="flex-shrink-0">
            <button type="button" class="remove-btn w-10 h-10 flex items-center justify-center bg-red-100 hover:bg-red-200 text-red-600 rounded-lg transition-colors group">
                <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </button>
        </div>
    </div>
`;

            ingredientsContainer.appendChild(newRow);
            initializeDropdown(newRow);
            toggleEmptyState();

            // Entrance animation
            setTimeout(() => {
                newRow.style.transition = 'all 0.3s ease-out';
                newRow.style.opacity = '1';
                newRow.style.transform = 'translateY(0)';
            }, 10);
        }

        // Make a newly added ingredient row interactive
        function initializeDropdown(context) {
            const dropdownButton = context.querySelector('.dropdown-button');
            const dropdownMenu = context.querySelector('.dropdown-menu');
            const searchInput = context.querySelector('.search-input');
            const options = context.querySelectorAll('.option-item');
            const hiddenInput = context.querySelector('input[type="hidden"]');
            const dropdownLabel = context.querySelector('.dropdown-label');
            const removeBtn = context.querySelector('.remove-btn');

            dropdownButton.addEventListener('click', (e) => {
                e.stopPropagation();
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    if (menu !== dropdownMenu) menu.classList.add('hidden');
                });
                dropdownMenu.classList.toggle('hidden');
                if (!dropdownMenu.classList.contains('hidden')) {
                    searchInput.focus();
                }
            });

            options.forEach(option => {
                option.addEventListener('click', (e) => {
                    e.preventDefault();
                    hiddenInput.value = option.getAttribute('data-value');
                    dropdownLabel.textContent = option.getAttribute('data-text');
                    dropdownLabel.classList.remove('text-gray-500');
                    dropdownLabel.classList.add('text-gray-900');
                    dropdownMenu.classList.add('hidden');
                    hiddenInput.dispatchEvent(new Event('change', { bubbles: true }));
                });
            });

            searchInput.addEventListener('input', () => {
                const searchTerm = searchInput.value.toLowerCase();
                options.forEach(option => {
                    const matches = option.textContent.toLowerCase().includes(searchTerm);
                    option.style.display = matches ? 'block' : 'none';
                });
            });

            removeBtn.addEventListener('click', () => {
                context.style.transition = 'all 0.3s ease-in';
                context.style.opacity = '0';
                context.style.transform = 'translateX(20px)';
                setTimeout(() => {
                    context.remove();
                    updateTotals();
                    toggleEmptyState();
                }, 300);
            });
        }

        // --- GLOBAL EVENT LISTENERS ---

        // Listen for any input changes to update totals
        ingredientsContainer.addEventListener('input', (e) => {
            if (e.target.matches('input[type="number"]')) updateTotals();
        });
        ingredientsContainer.addEventListener('change', (e) => {
            if (e.target.matches('input[type="hidden"], select')) updateTotals();
        });

        // Initialize the page state when it loads
        document.addEventListener('DOMContentLoaded', () => {
            toggleEmptyState();
        });

        // Close dropdowns if clicking outside of them
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.dropdown-menu') && !e.target.closest('.dropdown-button')) {
                document.querySelectorAll('.dropdown-menu').forEach(menu => menu.classList.add('hidden'));
            }
        });

        // Handle the image preview
        imageInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePlaceholder.classList.add('hidden');
                    imagePreview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</x-app-layout>
