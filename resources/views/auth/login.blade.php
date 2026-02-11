<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full">
            <!-- Logo -->
            <div class="flex justify-center mb-8">
                <div class="bg-blue-600 rounded-2xl p-4 shadow-lg">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                        </path>
                    </svg>
                </div>
            </div>

            <!-- Header -->
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Welcome Back</h2>
                <p class="text-gray-600">Please sign in to access your dashboard</p>
            </div>

            <!-- Tab Buttons -->
            <div class="flex gap-4 mb-6">
                <button type="button" onclick="setRole('student')" id="studentBtn"
                        class="flex-1 py-3 px-4 bg-blue-600 text-white rounded-lg font-medium flex items-center justify-center gap-2 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Student / Parent
                </button>
                <button type="button" onclick="setRole('admin')" id="adminBtn"
                        class="flex-1 py-3 px-4 bg-gray-100 text-gray-600 rounded-lg font-medium flex items-center justify-center gap-2 transition hover:bg-gray-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                    Admin / Staff
                </button>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            @if(session('error'))
                <p class="text-red-500 text-sm mb-4">{{ session('error') }}</p>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Hidden Role Input -->
                <input type="hidden" name="role" id="role" value="student">

                <!-- Email Address -->
                <div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </span>
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus
                               autocomplete="username" placeholder="student@school.edu"
                               class="block w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition"/>
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                </div>

                <!-- Password -->
                <div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </span>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                               placeholder="••••••••••"
                               class="block w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition"/>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="flex items-center">
                        <input id="remember_me" type="checkbox"
                               class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" name="remember">
                        <span class="ml-2 text-sm text-gray-700">Remember me</span>
                    </label>

                    @if(Route::has('password.request'))
                        <a class="text-sm text-blue-600 hover:text-blue-700 font-medium"
                           href="{{ route('password.request') }}">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <!-- Sign In Button -->
                <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition flex items-center justify-center gap-2 shadow-lg shadow-blue-600/30">
                    Sign In
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </button>

                <!-- Contact Administration -->
                <p class="text-center text-sm text-gray-600 mt-6">
                    Don't have an account?
                    <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">Contact Administration</a>
                </p>
            </form>

            <!-- Help Button -->
            <button class="fixed bottom-8 right-8 bg-gray-800 hover:bg-gray-900 text-white w-12 h-12 rounded-full shadow-lg flex items-center justify-center transition">
                <span class="text-xl font-semibold">?</span>
            </button>
        </div>
    </div>

    <!-- JS untuk switch role -->
    <script>
        function setRole(role) {
            document.getElementById('role').value = role;

            const studentBtn = document.getElementById('studentBtn');
            const adminBtn = document.getElementById('adminBtn');

            if (role === 'student') {
                studentBtn.classList.add('bg-blue-600', 'text-white');
                studentBtn.classList.remove('bg-gray-100', 'text-gray-600');
                adminBtn.classList.remove('bg-blue-600', 'text-white');
                adminBtn.classList.add('bg-gray-100', 'text-gray-600');
            } else {
                adminBtn.classList.add('bg-blue-600', 'text-white');
                adminBtn.classList.remove('bg-gray-100', 'text-gray-600');
                studentBtn.classList.remove('bg-blue-600', 'text-white');
                studentBtn.classList.add('bg-gray-100', 'text-gray-600');
            }
        }
    </script>
</x-guest-layout>