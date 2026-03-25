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

        <!-- Analytics Cards Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Monthly Activity -->
            <div class="bg-white/80 backdrop-blur-md rounded-2xl p-8 shadow-xl border border-white/50 min-h-[400px]">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-bold text-gray-900">Monthly Activity</h3>
                    <div class="text-sm text-gray-500 font-medium">{{ count($monthlyActivity) }} Months</div>
                </div>
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/10 to-blue-600/10 rounded-2xl -m-1"></div>
                <div class="relative overflow-x-auto">
                    <table class="w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50 rounded-lg">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Month</th>
                                <th class="px-6 py-3 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">Transactions</th>
                                <th class="px-6 py-3 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">Total Amount</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($monthlyActivity as $data)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ date('F', mktime(0, 0, 0, $data->month, 10)) }}</td>
                                    <td class="px-6 py-4 text-right text-gray-900 font-medium">{{ number_format($data->total_transactions) }}</td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="font-bold text-green-600">₱{{ number_format($data->total_amount, 2) }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-12 text-center text-gray-500">No activity this year</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Top Users -->
            <div class="bg-white/80 backdrop-blur-md rounded-2xl p-8 shadow-xl border border-white/50 min-h-[400px]">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-bold text-gray-900">Top Users</h3>
                    <div class="text-sm text-gray-500 font-medium">{{ count($topUsers) }} Users</div>
                </div>
                <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/10 to-green-600/10 rounded-2xl -m-1"></div>
                <div class="relative overflow-x-auto">
                    <table class="w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50 rounded-lg">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">User</th>
                                <th class="px-6 py-3 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">Transactions</th>
                                <th class="px-6 py-3 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">Total Amount</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($topUsers as $index => $user)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mr-2">
                                            #{{ $index + 1 }}
                                        </span>
                                        {{ $user->name }}
                                    </td>
                                    <td class="px-6 py-4 text-right text-gray-900 font-medium">{{ number_format($user->total_transactions) }}</td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="font-bold text-green-600">₱{{ number_format($user->total_amount, 2) }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-12 text-center text-gray-500">No user activity</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
