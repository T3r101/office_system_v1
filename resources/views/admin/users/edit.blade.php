@extends('layouts.dashboard')

@section('title', 'Edit User - ' . $user->name)

@section('content')
<div class="max-w-4xl mx-auto px-6 py-8">
    <div class="mb-8">
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-xl font-medium shadow-lg transition-all">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Users
        </a>
    </div>

    <div class="bg-white shadow-2xl rounded-3xl border border-gray-200 overflow-hidden">
        <div class="p-8 border-b border-gray-200">
            <h1 class="text-3xl font-bold text-gray-900">Edit User</h1>
            <p class="mt-2 text-gray-600">Update {{ $user->name }} account details</p>
        </div>

        <form method="POST" action="{{ route('admin.users.update', $user) }}" class="p-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Personal Info -->
                <div>
                    <h3 class="text-lg font-bold text-gray-900 mb-6">Personal Information</h3>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm" required>
                            @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm" required>
                            @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm">
                            @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                            <textarea name="address" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm">{{ old('address', $user->address) }}</textarea>
                            @error('address') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Password (leave blank to keep current)</label>
                            <input type="password" name="password" class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm">
                            @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <!-- Role & Status -->
                <div>
                    <h3 class="text-lg font-bold text-gray-900 mb-6">Permissions & Status</h3>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Role</label>
                            <select name="role" class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm" required>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                                <option value="cto" {{ old('role', $user->role) == 'cto' ? 'selected' : '' }}>CTO</option>
                            </select>
                            @error('role') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="flex items-center text-sm font-medium text-gray-700 mb-3">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $user->is_active) ? 'checked' : '' }} class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                <span class="ml-2">Account Active</span>
                            </label>
                            @error('is_active') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            <p class="text-xs text-gray-500 mt-1">Inactive accounts cannot login</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end space-x-4 pt-8 border-t border-gray-200 mt-12">
                <a href="{{ route('admin.users.index') }}" class="px-8 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold rounded-2xl shadow-lg transition-all">
                    Cancel
                </a>
                <button type="submit" class="px-10 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-bold rounded-2xl shadow-2xl hover:shadow-3xl transition-all">
                    Update User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

