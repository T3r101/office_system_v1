@extends('layouts.dashboard')

@section('title', 'Account Management')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    <!-- Account Header -->
    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white p-8 rounded-2xl shadow-2xl">
        <div class="flex flex-col md:flex-row md:items-center gap-6">
            <div class="flex-shrink-0">
                <div class="w-24 h-24 bg-white/20 rounded-2xl flex items-center justify-center">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
            </div>
            <div class="flex-1 min-w-0">
                <h1 class="text-3xl font-bold mb-2">{{ auth()->user()->name }}</h1>
                <p class="text-blue-100 text-lg mb-1">{{ auth()->user()->email }}</p>
                <div class="flex flex-wrap gap-4 text-sm">
                    <span class="px-3 py-1 bg-white/20 rounded-full">{{ ucfirst(auth()->user()->role ?? 'user') }}</span>
                    <span class="px-3 py-1 bg-white/20 rounded-full">{{ auth()->user()->is_active ? 'Active' : 'Suspended' }}</span>
                    <span class="px-3 py-1 bg-white/20 rounded-full">Member since {{ auth()->user()->created_at->format('M Y') }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Personal Information -->
        <div class="lg:col-span-1 bg-white shadow-lg rounded-2xl p-8 border border-gray-100">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                <svg class="w-7 h-7 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Personal Info
            </h2>
@include('profile.partials.update-profile-information-form')

<style>
.profile-section {
    scroll-margin-top: 100px;
}
.profile-section button, .profile-section a {
    transition: all 0.2s ease;
}
.profile-section button:hover, .profile-section a:hover {
    transform: scale(1.05);
}
.profile-section button:active, .profile-section a:active {
    transform: scale(0.98);
}
</style>
        </div>

        <!-- Security & Password -->
        <div class="lg:col-span-1 bg-white shadow-lg rounded-2xl p-8 border border-gray-100">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                <svg class="w-7 h-7 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
                Security
            </h2>
@include('profile.partials.update-password-form')
<!-- Two-Factor Auth (Disabled - Breeze basic app) -->
<div class="p-6 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200 text-center">
    <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
    </svg>
    <h3 class="text-lg font-medium text-gray-900 mb-2">Two-Factor Authentication</h3>
    <p class="text-gray-600 mb-4">Available in Laravel Jetstream/Fortify. Enable for extra security.</p>
</div>
        </div>
    </div>

    <div class="space-y-6">
        <!-- Sessions -->
        <div class="bg-white shadow-lg rounded-2xl p-8 border border-gray-100">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                <svg class="w-7 h-7 mr-3 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Active Sessions
            </h2>
<!-- Sessions Management (Disabled - Breeze basic app) -->
<div class="p-6 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200 text-center">
    <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
    </svg>
    <h3 class="text-lg font-medium text-gray-900 mb-2">Active Sessions</h3>
    <p class="text-gray-600 mb-4">Available in Jetstream. Track/manage browser sessions here.</p>
    <div class="text-sm text-gray-500">Current Session: {{ request()->ip() }}</div>
</div>
        </div>

        <!-- API Tokens (Admin only) -->
        @if(auth()->user()->role === 'admin')
        <div class="bg-white shadow-lg rounded-2xl p-8 border border-gray-100">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                <svg class="w-7 h-7 mr-3 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                API Tokens
            </h2>
<!-- API Tokens (Disabled - Breeze basic app) -->
<div class="p-6 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200 text-center">
    <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
    </svg>
    <h3 class="text-lg font-medium text-gray-900 mb-2">API Tokens</h3>
    <p class="text-gray-600 mb-4">Admin API access. Available in Sanctum/Jetstream.</p>
</div>
        </div>
        @endif

        <!-- Danger Zone -->
        <div class="bg-gradient-to-r from-red-50 to-orange-50 border border-red-100 shadow-lg rounded-2xl p-8">
            <h2 class="text-2xl font-bold text-red-900 mb-6 flex items-center">
                <svg class="w-7 h-7 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
                Danger Zone
            </h2>
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</section>

@push('scripts')
<script>
    // Smooth tabs (if needed)
    document.addEventListener('DOMContentLoaded', function() {
        const sections = document.querySelectorAll('.profile-section');
        sections.forEach(section => {
            section.scrollIntoView({ behavior: 'smooth' });
        });
    });
</script>
@endpush>
@endsection

