<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-purple-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl w-full space-y-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">
                    Profile Management
                </h2>
                <p class="mt-1 text-center text-sm text-gray-600 max-w">
                    Update your account information and manage your profile.
                </p>
            </div>

            <!-- Profile Card -->
            <div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-2xl border border-white/50 p-10 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-500 via-purple-500 to-indigo-600 opacity-10 -m-1 rounded-3xl"></div>
                <div class="relative z-10">
                    @if (session('status'))
                        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="text-center mb-8">
                        <div class="mx-auto w-32 h-32 mb-6 relative">
                            @if ($user->profile_photo)
                                <img class="w-full h-full rounded-full object-cover shadow-2xl ring-4 ring-white" src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}">
                            @else
                                <div class="w-full h-full bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center shadow-2xl ring-4 ring-white text-white font-bold text-3xl">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                            @endif
                            <label for="profile_photo" class="absolute -bottom-2 -right-2 bg-gradient-to-r from-blue-500 to-purple-600 p-3 rounded-full shadow-lg cursor-pointer hover:shadow-xl transition-all duration-300 hover:scale-110">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <input id="profile_photo" name="profile_photo" type="file" class="hidden" accept="image/*">
                            </label>
                            @error('profile_photo')
                                <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <!-- Name -->
                        <div class="mb-6">
                            <x-input-label for="name" value="Name" />
                            <x-text-input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus />
                            <x-input-error for="name" />
                        </div>

                        <!-- Email -->
                        <div class="mb-6">
                            <x-input-label for="email" value="Email" />
                            <x-text-input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required />
                            <x-input-error for="email" />
                        </div>

                        <!-- Role -->
                        <div class="mb-6">
                            <x-input-label for="role" value="Role" />
                            <select id="role" name="role" class="block w-full mt-1 border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            <x-input-error for="role" />
                        </div>

                        <!-- Account Created -->
                        <div class="mb-8 p-4 bg-gray-50 rounded-xl">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Account Created</label>
                            <p class="text-lg font-semibold text-gray-900">{{ $user->created_at->format('F j, Y') }}</p>
                        </div>

                        <!-- Password -->
                        <div class="mb-6">
                            <x-input-label for="password" value="New Password (optional)" />
                            <x-text-input id="password" name="password" type="password" autocomplete="new-password" />
                            <x-input-error for="password" />
                            <x-input-label for="password_confirmation" value="Confirm Password" class="mt-2 block" />
                            <x-text-input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" />
                            <x-input-error for="password_confirmation" />
                        </div>

                        <!-- Update Button -->
                        <div class="flex justify-end">
                            <x-primary-button>
                                Update Profile
                            </x-primary-button>
                        </div>
                    </form>

                    <!-- Delete Account Section (optional, below main form) -->
                    <div class="mt-10 pt-10 border-t border-gray-200">
                        <form method="POST" action="{{ route('profile.destroy') }}" class="flex items-center justify-end">
                            @csrf
                            @method('DELETE')
                            <x-secondary-button class="mr-3">Cancel</x-secondary-button>
                            <x-danger-button>Delete Account</x-danger-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

