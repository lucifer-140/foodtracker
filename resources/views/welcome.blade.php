<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'FoodTracker') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0fdf4',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-white text-gray-900 antialiased">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <h1 class="text-xl font-bold text-primary-600">FoodTracker</h1>
                    </div>
                </div>
                
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-8">
                        <a href="#" class="text-gray-900 hover:text-primary-600 px-3 py-2 text-sm font-medium transition-colors">Home</a>
                        <a href="#features" class="text-gray-600 hover:text-primary-600 px-3 py-2 text-sm font-medium transition-colors">Features</a>
                        <a href="{{ url('/register') }}" class="text-gray-600 hover:text-primary-600 px-3 py-2 text-sm font-medium transition-colors">Sign Up</a>
                        <a href="{{ url('/login') }}" class="text-gray-600 hover:text-primary-600 px-3 py-2 text-sm font-medium transition-colors">Login</a>
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button type="button" class="text-gray-600 hover:text-primary-600 focus:outline-none focus:text-primary-600" onclick="toggleMobileMenu()">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div id="mobile-menu" class="md:hidden hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white border-t border-gray-100">
                <a href="#" class="text-gray-900 hover:text-primary-600 block px-3 py-2 text-base font-medium">Home</a>
                <a href="#features" class="text-gray-600 hover:text-primary-600 block px-3 py-2 text-base font-medium">Features</a>
                <a href="#" class="text-gray-600 hover:text-primary-600 block px-3 py-2 text-base font-medium">Sign Up</a>
                <a href="#" class="text-gray-600 hover:text-primary-600 block px-3 py-2 text-base font-medium">Login</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
            <div class="text-center">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 mb-6">
                    Track Your Meals,
                    <span class="text-primary-600">Stay Healthy</span>
                </h1>
                <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                    Log your daily meals and stay on top of your nutrition with our simple and intuitive food tracking app
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ url('/login') }}" class="bg-primary-600 hover:bg-primary-700 text-white font-semibold py-3 px-8 rounded-lg transition-colors shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                        Get Started Free
                    </a>
                    <a href="#features" class="bg-white hover:bg-gray-50 text-gray-900 font-semibold py-3 px-8 rounded-lg border border-gray-300 transition-colors">
                        Learn More
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                    Everything you need to track your nutrition
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Our comprehensive food tracking tools help you maintain a healthy lifestyle with ease
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1: Calorie Counting -->
                <div class="text-center p-6 rounded-xl bg-gray-50 hover:bg-gray-100 transition-colors">
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Calorie Counting</h3>
                    <p class="text-gray-600">
                        Easily track your daily calorie intake with our extensive food database and smart logging features
                    </p>
                </div>

                <!-- Feature 2: Meal History -->
                <div class="text-center p-6 rounded-xl bg-gray-50 hover:bg-gray-100 transition-colors">
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Meal History</h3>
                    <p class="text-gray-600">
                        Keep a detailed record of all your meals and review your eating patterns over time
                    </p>
                </div>

                <!-- Feature 3: Progress Charts -->
                <div class="text-center p-6 rounded-xl bg-gray-50 hover:bg-gray-100 transition-colors">
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Progress Charts</h3>
                    <p class="text-gray-600">
                        Visualize your nutrition goals with beautiful charts and track your progress over time
                    </p>
                </div>
            </div>
        </div>
    </section>



    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 text-sm py-6">
  <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
    <p>&copy; {{ date('Y') }} FoodTracker</p>
    <div class="flex space-x-4">
      <a href="#" class="hover:text-white transition-colors">Privacy</a>
      <a href="#" class="hover:text-white transition-colors">Terms</a>
      <a href="#" class="hover:text-white transition-colors">Contact</a>
    </div>
  </div>
</footer>


    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }
    </script>
</body>
</html>