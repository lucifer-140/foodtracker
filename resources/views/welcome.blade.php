
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
                            100: '#dcfce7',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                        }
                    },
                    animation: {
                        'fade-in-up': 'fadeInUp 0.6s ease-out',
                        'fade-in': 'fadeIn 0.8s ease-out',
                        'bounce-slow': 'bounce 2s infinite',
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        html { scroll-behavior: smooth; }
        .gradient-bg {
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 50%, #bbf7d0 100%);
        }
    </style>
</head>
<body class="bg-white text-gray-900 antialiased">
<nav class="bg-white/95 backdrop-blur-sm shadow-sm border-b border-gray-100 fixed w-full top-0 z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <h1 class="text-xl font-bold text-primary-600 hover:text-primary-700 transition-colors">🍎 FoodTracker</h1>
                </div>
            </div>

            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-8">
                    <a href="#home" class="text-gray-900 hover:text-primary-600 px-3 py-2 text-sm font-medium transition-all duration-200 hover:scale-105">Home</a>
                    <a href="#features" class="text-gray-600 hover:text-primary-600 px-3 py-2 text-sm font-medium transition-all duration-200 hover:scale-105">Features</a>
                    <a href="#testimonials" class="text-gray-600 hover:text-primary-600 px-3 py-2 text-sm font-medium transition-all duration-200 hover:scale-105">Reviews</a>
                    <a href="{{ route('register') }}" class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 hover:scale-105 shadow-md hover:shadow-lg">Sign Up</a>
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-primary-600 px-3 py-2 text-sm font-medium transition-all duration-200 hover:scale-105">Login</a>
                </div>
            </div>

            <div class="md:hidden">
                <button type="button" class="text-gray-600 hover:text-primary-600 focus:outline-none focus:text-primary-600 transition-colors" onclick="toggleMobileMenu()">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div id="mobile-menu" class="md:hidden hidden">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white/95 backdrop-blur-sm border-t border-gray-100">
            <a href="#home" class="text-gray-900 hover:text-primary-600 block px-3 py-2 text-base font-medium transition-colors">Home</a>
            <a href="#features" class="text-gray-600 hover:text-primary-600 block px-3 py-2 text-base font-medium transition-colors">Features</a>
            <a href="#testimonials" class="text-gray-600 hover:text-primary-600 block px-3 py-2 text-base font-medium transition-colors">Reviews</a>
            <a href="{{ route('register') }}" class="text-gray-600 hover:text-primary-600 block px-3 py-2 text-base font-medium transition-colors">Sign Up</a>
            <a href="{{ route('login') }}" class="text-gray-600 hover:text-primary-600 block px-3 py-2 text-base font-medium transition-colors">Login</a>
        </div>
    </div>
</nav>

<section id="home" class="gradient-bg pt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
        <div class="text-center animate-fade-in-up">
            <div class="mb-6">
                <span class="inline-block text-6xl animate-bounce-slow">🥗</span>
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 mb-6">
                Track Your Meals,
                <span class="text-primary-600 bg-gradient-to-r from-primary-500 to-primary-700 bg-clip-text text-transparent">Stay Healthy</span>
            </h1>
            <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto leading-relaxed">
                Log your daily meals and stay on top of your nutrition with our simple and intuitive food tracking app. Join thousands of users living healthier lives!
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('login') }}" class="group bg-primary-600 hover:bg-primary-700 text-white font-semibold py-4 px-8 rounded-xl transition-all duration-300 shadow-lg hover:shadow-2xl transform hover:-translate-y-1 hover:scale-105">
                        <span class="flex items-center justify-center">
                            Get Started Free
                            <svg class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </span>
                </a>
                <a href="#features" class="bg-white/80 backdrop-blur-sm hover:bg-white text-gray-900 font-semibold py-4 px-8 rounded-xl border border-gray-200 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-1">
                    Learn More
                </a>
            </div>

            <div class="mt-16 grid grid-cols-1 sm:grid-cols-3 gap-8 max-w-2xl mx-auto">
                <div class="text-center">
                    <div class="text-3xl font-bold text-primary-600">10K+</div>
                    <div class="text-gray-600">Active Users</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-primary-600">1M+</div>
                    <div class="text-gray-600">Meals Tracked</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-primary-600">4.9★</div>
                    <div class="text-gray-600">User Rating</div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="features" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 animate-fade-in-up">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                Everything you need to track your nutrition
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Our comprehensive food tracking tools help you maintain a healthy lifestyle with ease
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="group text-center p-8 rounded-2xl bg-gradient-to-br from-gray-50 to-gray-100 hover:from-primary-50 hover:to-primary-100 transition-all duration-300 transform hover:-translate-y-2 hover:shadow-xl">
                <div class="w-20 h-20 bg-primary-100 group-hover:bg-primary-200 rounded-2xl flex items-center justify-center mx-auto mb-6 transition-all duration-300 group-hover:scale-110">
                    <svg class="w-10 h-10 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Smart Calorie Counting</h3>
                <p class="text-gray-600 leading-relaxed">
                    Easily track your daily calorie intake with our extensive food database and AI-powered smart logging features
                </p>
            </div>

            <div class="group text-center p-8 rounded-2xl bg-gradient-to-br from-gray-50 to-gray-100 hover:from-primary-50 hover:to-primary-100 transition-all duration-300 transform hover:-translate-y-2 hover:shadow-xl">
                <div class="w-20 h-20 bg-primary-100 group-hover:bg-primary-200 rounded-2xl flex items-center justify-center mx-auto mb-6 transition-all duration-300 group-hover:scale-110">
                    <svg class="w-10 h-10 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Detailed Meal History</h3>
                <p class="text-gray-600 leading-relaxed">
                    Keep a comprehensive record of all your meals and review your eating patterns over time with insights
                </p>
            </div>

            <div class="group text-center p-8 rounded-2xl bg-gradient-to-br from-gray-50 to-gray-100 hover:from-primary-50 hover:to-primary-100 transition-all duration-300 transform hover:-translate-y-2 hover:shadow-xl">
                <div class="w-20 h-20 bg-primary-100 group-hover:bg-primary-200 rounded-2xl flex items-center justify-center mx-auto mb-6 transition-all duration-300 group-hover:scale-110">
                    <svg class="w-10 h-10 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Beautiful Progress Charts</h3>
                <p class="text-gray-600 leading-relaxed">
                    Visualize your nutrition goals with stunning interactive charts and track your progress over time
                </p>
            </div>
        </div>
    </div>
</section>

<section id="testimonials" class="py-20 bg-gradient-to-br from-gray-50 to-primary-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                What our users are saying
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Join thousands of satisfied users who have transformed their eating habits
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center mb-4">
                    <div class="flex text-yellow-400">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    </div>
                </div>
                <p class="text-gray-600 mb-6 italic">
                    "FoodTracker has completely changed how I approach nutrition. The interface is so intuitive and the progress tracking keeps me motivated!"
                </p>
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center mr-4">
                        <span class="text-primary-600 font-semibold">SM</span>
                    </div>
                    <div>
                        <div class="font-semibold text-gray-900">Sarah Miller</div>
                        <div class="text-gray-500 text-sm">Fitness Enthusiast</div>
                    </div>
                </div>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center mb-4">
                    <div class="flex text-yellow-400">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    </div>
                </div>
                <p class="text-gray-600 mb-6 italic">
                    "As a busy professional, I needed something simple yet powerful. FoodTracker delivers exactly that with beautiful charts and insights."
                </p>
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center mr-4">
                        <span class="text-primary-600 font-semibold">MJ</span>
                    </div>
                    <div>
                        <div class="font-semibold text-gray-900">Michael Johnson</div>
                        <div class="text-gray-500 text-sm">Software Engineer</div>
                    </div>
                </div>
            </div>


            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center mb-4">
                    <div class="flex text-yellow-400">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    </div>
                </div>
                <p class="text-gray-600 mb-6 italic">
                    "I've tried many nutrition apps, but FoodTracker stands out with its clean design and comprehensive tracking features. Highly recommended!"
                </p>
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center mr-4">
                        <span class="text-primary-600 font-semibold">ED</span>
                    </div>
                    <div>
                        <div class="font-semibold text-gray-900">Emily Davis</div>
                        <div class="text-gray-500 text-sm">Nutritionist</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="py-20 bg-primary-600">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">
            Ready to start your healthy journey?
        </h2>
        <p class="text-xl text-primary-100 mb-8 max-w-2xl mx-auto">
            Join thousands of users who have already transformed their eating habits with FoodTracker
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('register') }}" class="bg-white hover:bg-gray-100 text-primary-600 font-semibold py-4 px-8 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105">
                Start Free Today
            </a>
            <a href="{{ route('login') }}" class="border-2 border-white text-white hover:bg-white hover:text-primary-600 font-semibold py-4 px-8 rounded-xl transition-all duration-300">
                Sign In
            </a>
        </div>
    </div>
</section>


<footer class="bg-gray-900 text-gray-400 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
            <div class="col-span-1 md:col-span-2">
                <h3 class="text-xl font-bold text-white mb-4">🍎 FoodTracker</h3>
                <p class="text-gray-400 mb-4 max-w-md">
                    The most intuitive way to track your nutrition and maintain a healthy lifestyle. Join our community of health-conscious individuals.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001.012.001z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <div>
                <h4 class="text-white font-semibold mb-4">Product</h4>
                <ul class="space-y-2">
                    <li><a href="#features" class="hover:text-white transition-colors">Features</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Pricing</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">API</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Mobile App</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-semibold mb-4">Support</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-white transition-colors">Help Center</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Contact Us</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Terms of Service</a></li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-800 pt-8 flex flex-col sm:flex-row justify-between items-center">
            <p>&copy; {{ date('Y') }} FoodTracker. All rights reserved.</p>
        </div>
    </div>
</footer>

<script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    }


    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });


    window.addEventListener('scroll', function() {
        const nav = document.querySelector('nav');
        if (window.scrollY > 100) {
            nav.classList.add('bg-white/95');
            nav.classList.remove('bg-white/95');
        }
    });
</script>
</body>
</html>
