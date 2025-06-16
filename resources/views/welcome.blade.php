<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodTracker - Welcome</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-900">

<div class="min-h-screen flex flex-col justify-center items-center py-12 px-6">
    <div class="w-full max-w-3xl bg-white rounded-xl shadow-lg p-8">

        <div class="mb-8 text-center">
            <div class="text-5xl font-extrabold text-green-600 mb-2">FoodTracker</div>
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Track your meals. Stay healthy.</h1>
            <p class="text-lg text-gray-600">
                Simple and efficient way to monitor your daily nutrition intake.
            </p>
        </div>

        <div class="flex flex-col sm:flex-row justify-center gap-4 mb-12">
            <a href="{{ url('/login') }}" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Login
            </a>
            <a href="{{ url('/register') }}" class="inline-flex items-center px-6 py-3 bg-white border border-gray-300 rounded-md font-semibold text-lg text-gray-800 uppercase tracking-widest hover:bg-gray-50 transition ease-in-out duration-150">
                Register
            </a>
        </div>

        <div class="text-center text-sm text-gray-500">
            &copy; {{ now()->year }} FoodTracker. All rights reserved.
        </div>

    </div>
</div>

</body>
</html>
