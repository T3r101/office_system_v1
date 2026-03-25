<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
        <div class="w-full max-w-md">
            <div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-2xl p-12 relative overflow-hidden border border-white/30">
                {{-- Gradient Border --}}
                <div class="absolute inset-0 bg-gradient-to-r from-blue-500 via-purple-600 to-indigo-600 opacity-[0.15] rounded-3xl blur-xl -inset-1 animate-pulse"></div>
                <div class="relative z-10">
                    <div class="text-center mb-10">
                        <h2 class="text-4xl font-bold bg-gradient-to-r from-gray-800 to-slate-700 bg-clip-text text-transparent mb-2">Create Account</h2>
                        <p class="text-gray-600">Join us today</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- Name --}}
                        <div class="mb-6">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="mt-1 block w-full rounded-xl border border-gray-200 bg-white/50 backdrop-blur-sm shadow-sm focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        {{-- Email --}}
                        <div class="mb-6">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="mt-1 block w-full rounded-xl border border-gray-200 bg-white/50 backdrop-blur-sm shadow-sm focus:ring-4 focus:ring-purple-500/20 focus:border-purple-500 transition-all duration-300" type="email" name="email" :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        {{-- Password --}}
                        <div class="mb-6">
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input id="password" class="mt-1 block w-full rounded-xl border border-gray-200 bg-white/50 backdrop-blur-sm shadow-sm focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-300" type="password" name="password" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        {{-- Confirm Password --}}
                        <div class="mb-8">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                            <x-text-input id="password_confirmation" class="mt-1 block w-full rounded-xl border border-gray-200 bg-white/50 backdrop-blur-sm shadow-sm focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-300" type="password" name="password_confirmation" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        {{-- Register Button --}}
                        <div class="mb-8">
                            <x-primary-button class="w-full">
                                {{ __('Register') }}
                            </x-primary-button>
                        </div>
                    </form>

                    {{-- Login Link --}}
                    <div class="text-center">
                        <p class="text-sm text-gray-600">
                            {{ __('Already have an account?') }}
                            <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-500 transition-colors ml-1">
                                {{ __('Log in') }}
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
