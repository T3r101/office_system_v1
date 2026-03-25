@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
<div class="py-8 px-6 max-w-7xl mx-auto">
    <div class="space-y-8">
        <div class="flex flex-col md:flex-row gap-6">
            <!-- Summary Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 flex-1">
                <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 shadow-xl border border-white/50 hover:shadow-2xl transition-all duration-300 min-h-[120px] flex items-center">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-600 opacity-20 rounded-2xl -m-1"></div>
                    <div class="relative z-10 w-full">
                        <div class="flex items-center justify-between">
                            <div class="p-3 bg-blue-100 rounded-xl">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div class="ml-4 flex-1">
                                <p class="text-sm font-medium text-gray-600 truncate">Total Records</p>
                                <p class="text-2xl md:text-3xl font-bold text-gray-900">{{ $totalRecords ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 shadow-xl border border-white/50 hover:shadow-2xl transition-all duration-300 min-h-[120px] flex items-center">
                    <div class="absolute inset-0 bg-gradient-to-r from-green-500 via-emerald-500 to-teal-600 opacity-20 rounded-2xl -m-1"></div>
                    <div class="relative z-10 w-full">
                        <div class="flex items-center justify-between">
                            <div class="p-3 bg-green-100 rounded-xl">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08 .402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                            </div>
                            <div class="ml-4 flex-1">
                                <p class="text-sm font-medium text-gray-600 truncate">Total Income</p>
                                <p class="text-2xl md:text-3xl font-bold text-gray-900">₱{{ number_format($incomeTotal ?? 0, 2) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 shadow-xl border border-white/50 hover:shadow-2xl transition-all duration-300 min-h-[120px] flex items-center">
                    <div class="absolute inset-0 bg-gradient-to-r from-red-500 via-orange-500 to-amber-600 opacity-20 rounded-2xl -m-1"></div>
                    <div class="relative z-10 w-full">
                        <div class="flex items-center justify-between">
                            <div class="p-3 bg-red-100 rounded-xl">
                                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08 .402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                            </div>
                            <div class="ml-4 flex-1">
                                <p class="text-sm font-medium text-gray-600 truncate">Total Expense</p>
                                <p class="text-2xl md:text-3xl font-bold text-gray-900">₱{{ number_format($expenseTotal ?? 0, 2) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 shadow-xl border border-white/50 hover:shadow-2xl transition-all duration-300 min-h-[120px] flex items-center">
                    <div class="absolute inset-0 bg-gradient-to-r from-amber-500 via-orange-500 to-yellow-600 opacity-20 rounded-2xl -m-1"></div>
                    <div class="relative z-10 w-full">
                        <div class="flex items-center justify-between">
                            <div class="p-3 bg-amber-100 rounded-xl">
                                <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="ml-4 flex-1">
                                <p class="text-sm font-medium text-gray-600 truncate">Total Deposits</p>
                                <p class="text-2xl md:text-3xl font-bold text-gray-900">₱{{ number_format($totalDeposits ?? 0, 2) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>





    </div>
</div>
@endsection
