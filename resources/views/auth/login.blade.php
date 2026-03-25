<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-b from-slate-100 to-blue-50">
        <div class="w-full max-w-6xl grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12 items-center">
            <!-- Left Logo -->
            <div class="hidden lg:block p-8 lg:p-12 relative overflow-hidden group">
                <div class="w-52 h-52 rounded-3xl bg-gradient-to-r from-blue-400 to-purple-500 p-4 mx-auto block shadow-2xl group-hover:scale-105 group-hover:rotate-3 transition-all duration-500 border-4 border-white/50 backdrop-blur-sm">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-full object-contain drop-shadow-xl mx-auto block">
                </div>
            </div>

            <!-- Login Card -->
            <div class="lg:col-span-1">
                <div class="max-w-sm mx-auto p-8 lg:p-10 bg-white/80 backdrop-blur-md rounded-3xl shadow-2xl border border-white/30 relative overflow-hidden">
                    <!-- Gradient Border -->
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-500 via-purple-600 to-indigo-600 opacity-[0.15] rounded-3xl blur-xl -inset-1 animate-pulse"></div>
                    <div class="relative z-10">
                        <div class="text-center mb-10 lg:mb-12">
                            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-3">Login</h2>
                            <p class="text-lg text-gray-600 font-medium">Office Management System</p>
                        </div>

                        <x-auth-session-status class="mb-6 lg:mb-8" :status="session('status')" />

                        <form method="POST" action="{{ route('login') }}" class="space-y-6 lg:space-y-8 leading-relaxed">
                            @csrf

                            <!-- Email -->
                            <div>
                                <x-input-label for="email" :value="__('Email')" class="text-lg lg:text-xl font-bold text-gray-900 mb-4 block" />
                                <x-text-input id="email" class="block w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500/50 shadow-sm py-3 lg:py-4 px-4 lg:px-5 text-base lg:text-lg font-medium transition-all duration-200 hover:border-gray-400 hover:shadow-md" 
                                        type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="your.email@company.com" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm lg:text-base text-red-600 font-medium" />
                            </div>

                            <!-- Password -->
                            <div>
                                <x-input-label for="password" :value="__('Password')" class="text-lg lg:text-xl font-bold text-gray-900 mb-4 block" />
                                <x-text-input id="password" class="block w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500/50 shadow-sm py-3 lg:py-4 px-4 lg:px-5 text-base lg:text-lg font-medium transition-all duration-200 hover:border-gray-400 hover:shadow-md"
                                        type="password" name="password" required autocomplete="current-password" placeholder="Password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm lg:text-base text-red-600 font-medium" />
                            </div>

                            @if (Route::has('password.request'))
                                <div class="text-center pt-1">
                                    <a href="{{ route('password.request') }}" class="inline-block text-sm lg:text-base text-blue-600 hover:text-blue-700 font-semibold hover:underline transition-colors duration-200">
                                        Forgot your password?
                                    </a>
                                </div>
                            @endif

                            <x-primary-button>
                                {{ __('Log in') }}
                            </x-primary-button>

                            <div class="text-center pt-6 border-t border-gray-200">
                                <p class="text-sm lg:text-base text-gray-700">
                                    New to Office System? Contact your administrator for account access
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right Logo -->
            <div class="hidden lg:block p-8 lg:p-12 relative overflow-hidden group">
                <div class="w-52 h-52 rounded-3xl bg-gradient-to-br from-emerald-400 to-teal-500 p-4 mx-auto block shadow-2xl group-hover:scale-105 group-hover:rotate-6 transition-all duration-500 border-4 border-white/50 backdrop-blur-sm">
                    <img src="{{ asset('images/logo1.png') }}" alt="Logo 1" class="w-full h-full object-contain drop-shadow-xl mx-auto block">
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>

