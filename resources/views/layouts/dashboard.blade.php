<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Office System') }} - @yield('title', 'Dashboard')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
    <body class="bg-gray-50 font-sans antialiased">

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg border-r border-gray-200 lg:translate-x-0 transition-transform -translate-x-full lg:translate-x-0" id="sidebar">
            <div class="flex flex-col h-full">
                <div class="p-6 bg-gradient-to-b from-blue-600 to-purple-600 text-white rounded-tr-lg">
                    <h1 class="text-2xl font-bold">Office System</h1>
                    <p class="text-sm opacity-90">{{ auth()->user()->name }}</p>
                </div>
                <nav class="flex-1 px-4 py-4 space-y-1">
                    <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 hover:scale-105 active:scale-95 text-white rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl font-medium {{ request()->routeIs('dashboard') ? 'ring-2 ring-blue-300 shadow-xl' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Dashboard
                    </a>
                    <a href="{{ route('import.excel') }}" class="flex items-center px-4 py-3 bg-gradient-to-r from-green-600 to-emerald-700 hover:from-green-700 hover:to-emerald-800 hover:scale-105 active:scale-95 text-white rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl font-medium {{ request()->routeIs('import.excel') ? 'ring-2 ring-green-300 shadow-xl' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.586l-1.414-1.414a1 1 0 00-1.414 0L10.586 15H8a1 1 0 00-1 1v3a1 1 0 001 1z"></path>
                        </svg>
                        Import Excel
                    </a>
                    <a href="{{ route('records.index') }}" class="flex items-center px-4 py-3 bg-gradient-to-r from-indigo-600 to-purple-700 hover:from-indigo-700 hover:to-purple-800 hover:scale-105 active:scale-95 text-white rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl font-medium {{ request()->routeIs('records.*') ? 'ring-2 ring-indigo-300 shadow-xl' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012 2m0 0h2a2 2 0 012 2v4m-4-6h4m0 0v4m0-4V6"></path>
                        </svg>
                        Records
                    </a>

                    <a href="{{ route('transactions.index') }}" class="flex items-center px-4 py-3 bg-gradient-to-r from-emerald-600 to-teal-700 hover:from-emerald-700 hover:to-teal-800 hover:scale-105 active:scale-95 text-white rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl font-medium {{ request()->routeIs('transactions.*') ? 'ring-2 ring-emerald-300 shadow-xl' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        New Transaction
                    </a>



                    <a href="{{ route('deposits.index') }}" class="flex items-center px-4 py-3 bg-gradient-to-r from-amber-600 to-orange-700 hover:from-amber-700 hover:to-orange-800 hover:scale-105 active:scale-95 text-white rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl font-medium {{ request()->routeIs('deposits.*') ? 'ring-2 ring-amber-300 shadow-xl' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                        Deposits
                    </a>

<div class="border-t border-gray-200 my-2"></div>
                    <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 hover:scale-105 active:scale-95 text-white rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl font-medium">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Profile
                    </a>

                    <a href="{{ route('accounts.index') }}" class="flex items-center px-4 py-3 bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 hover:scale-105 active:scale-95 text-white rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl font-medium {{ request()->routeIs('accounts.*') ? 'ring-2 ring-gray-300 shadow-xl' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-2 0H9m2 0v-7h-4m4 7v-7h4M9 7h1m-1 4h1m4 1h1m-1 1h1m0-5h1"></path>
                        </svg>
                        Acc.. Control
                    </a>

                    <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-3 bg-gradient-to-r from-indigo-600 to-purple-700 hover:from-indigo-700 hover:to-purple-800 hover:scale-105 active:scale-95 text-white rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl font-medium {{ request()->routeIs('admin.users.*') ? 'ring-2 ring-indigo-300 shadow-xl' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit / Update
                    </a>

<form method="POST" action="{{ route('logout') }}" class="flex items-center px-4 py-3 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 rounded-xl text-white transition-all duration-200 shadow-lg hover:shadow-xl font-medium">
                        @csrf
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <button type="submit">Logout</button>
                    </form>
                </nav>
            </div>
        </div>

        <!-- Main content -->
        <div class="flex-1 flex flex-col overflow-auto lg:ml-64 min-h-screen">
            <!-- Top bar -->
            <header class="bg-white shadow-sm border-b border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-600 mr-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    
                    <div class="flex items-center space-x-4 ml-auto">
                        <span class="text-sm text-gray-500">Welcome back, {{ auth()->user()->name }}!</span>
                        
                        <!-- Fullscreen Toggle Button -->
                        <button id="fullscreen-toggle" onclick="toggleFullscreen()" title="Fullscreen (F11)" class="p-2 rounded-lg bg-blue-100 hover:bg-blue-200 text-blue-600 transition-all hover:scale-105">
                            <svg id="fullscreen-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </header>

            <!-- Page content -->
            <main class="flex-1 p-6 overflow-y-auto">
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6 shadow-md">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-6 shadow-md">
                        {{ session('error') }}
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
        }

        // Fullscreen API - Production Ready
        function toggleFullscreen() {
            const elem = document.documentElement;
            let promise = Promise.resolve();
            
            if (!document.fullscreenElement) {
                if (elem.requestFullscreen) {
                    promise = elem.requestFullscreen();
                } else if (elem.webkitRequestFullscreen) {
                    promise = elem.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
                } else if (elem.msRequestFullscreen) {
                    promise = elem.msRequestFullscreen();
                }
            } else {
                if (document.exitFullscreen) {
                    promise = document.exitFullscreen();
                } else if (document.webkitExitFullscreen) {
                    promise = document.webkitExitFullscreen();
                } else if (document.msExitFullscreen) {
                    promise = document.msExitFullscreen();
                }
            }
            
            promise.catch(() => {
                // Silently fail if blocked
            });
        }

        // Persistent fullscreen - re-enter on navigation/user interaction
        let fullscreenPending = false;
        
        function attemptPersistentFullscreen() {
            if (!document.fullscreenElement && !fullscreenPending) {
                fullscreenPending = true;
                setTimeout(() => {
                    toggleFullscreen();
                    fullscreenPending = false;
                }, 100);
            }
        }

// No navigation interception - smooth module change
        // attemptPersistentFullscreen() triggers on DOMContentLoaded/load

        function updateFullscreenButton() {
            const button = document.getElementById('fullscreen-toggle');
            const icon = document.getElementById('fullscreen-icon');
            const isFullscreen = !!document.fullscreenElement;
            
            button.className = isFullscreen 
                ? 'p-2 rounded-lg bg-green-100 hover:bg-green-200 text-green-600 transition-all hover:scale-105' 
                : 'p-2 rounded-lg bg-blue-100 hover:bg-blue-200 text-blue-600 transition-all hover:scale-105';
            
            icon.innerHTML = isFullscreen 
                ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>' 
                : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>';
        }

        // Auto fullscreen with retry (handles browser prompts)
        function attemptFullscreen() {
            setTimeout(() => {
                toggleFullscreen();
            }, 500);
        }

        // Event listeners (de-duped)
        ['fullscreenchange', 'webkitfullscreenchange', 'msfullscreenchange'].forEach(event => {
            document.addEventListener(event, updateFullscreenButton);
        });


        // Auto + persistent - DISABLED to fix blinking
        // window.addEventListener('load', attemptPersistentFullscreen);
        // document.addEventListener('DOMContentLoaded', attemptPersistentFullscreen);
        
        // Reduced triggers - no more glitching
        // Every user interaction fallback DISABLED for smooth UX

        // Page visibility
        // Page visibility - DISABLED
        // document.addEventListener('visibilitychange', () => {
        //     if (!document.hidden) {
        //         attemptPersistentFullscreen();
        //     }
        // });
    </script>
    @stack('scripts')
</body>
</html>
