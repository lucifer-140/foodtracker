<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="food-tracker-bg flex items-center justify-center p-4">
        <div class="w-full max-w-md animate-fade-in">


            <!-- Login Card -->
            <div class="glass-card rounded-3xl shadow-xl p-8">
                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl flex items-center gap-3">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-green-800 text-sm">{{ session('status') }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Field -->
                    <div class="space-y-2">
                        <x-input-label for="email" :value="__('Email Address')" />
                        <x-text-input 
                            id="email" 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            placeholder="your@email.com"
                            class="input-field block w-full px-4 py-3 text-gray-900 placeholder-gray-500"
                            required 
                            autofocus 
                            autocomplete="username"
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password Field -->
                    <div class="space-y-2">
                    <x-input-label for="password" :value="__('Password')" />
                    <div class="relative">
                        <x-text-input 
                            id="password" 
                            type="password" 
                            name="password"
                            placeholder="Enter your password"
                            class="input-field block w-full px-4 py-3 pr-12 text-gray-900 placeholder-gray-500"
                            required 
                            autocomplete="current-password"
                        />

                        <!-- Eye icon inside input -->
                        <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-600" onclick="togglePassword()">
                            <svg id="eye-open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            <svg id="eye-closed" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                            </svg>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>


                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input 
                                id="remember_me" 
                                type="checkbox" 
                                name="remember"
                                class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 focus:ring-2"
                            />
                            <label for="remember_me" class="ml-2 text-sm text-gray-600 cursor-pointer">
                                {{ __('Remember me') }}
                            </label>
                        </div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm link-green font-medium">
                                {{ __('Forgot password?') }}
                            </a>
                        @endif
                    </div>

                    <!-- Login Button -->
                    <x-primary-button class="w-full h-12 text-white font-medium rounded-xl shadow-lg flex items-center justify-center">
                    {{ __('Sign In to Your Journey') }}
                    </x-primary-button>


                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-gray-500">New to FoodTracker?</span>
                    </div>
                </div>

                <!-- Sign Up Link -->
                <div class="text-center">
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="link-green font-medium">
                            {{ __('Create your free account') }}
                        </a>
                    @endif
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center mt-8 text-sm text-gray-500">
                <p>Start your healthy journey today 🥗</p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeOpen = document.getElementById('eye-open');
            const eyeClosed = document.getElementById('eye-closed');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            }
        }
    </script>
</x-guest-layout>