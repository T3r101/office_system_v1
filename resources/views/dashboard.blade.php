@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row gap-6">
        <!-- Summary Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
            <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 shadow-xl border border-white/50 hover:shadow-2xl transition-all duration-300">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-600 opacity-20 rounded-2xl -m-1"></div>
                <div class="relative z-10">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-100 rounded-xl">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Records</p>
<p class="text-lg font-bold text-gray-900">{{ number_format($totalRecords ?? 0) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 shadow-xl border border-white/50 hover:shadow-2xl transition-all duration-300">
                <div class="absolute inset-0 bg-gradient-to-r from-green-500 via-emerald-500 to-teal-600 opacity-20 rounded-2xl -m-1"></div>
                <div class="relative z-10">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-100 rounded-xl">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08 .402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Income</p>
<p class="text-lg font-bold text-gray-900">₱{{ number_format($incomeTotal ?? 0, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 shadow-xl border border-white/50 hover:shadow-2xl transition-all duration-300">
                <div class="absolute inset-0 bg-gradient-to-r from-red-500 via-orange-500 to-amber-600 opacity-20 rounded-2xl -m-1"></div>
                <div class="relative z-10">
                    <div class="flex items-center">
                        <div class="p-3 bg-red-100 rounded-xl">
                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08 .402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Expense</p>
<p class="text-2xl font-bold text-gray-900">₱{{ number_format($expenseTotal ?? 0, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 shadow-xl border border-white/50 hover:shadow-2xl transition-all duration-300">
                <div class="absolute inset-0 bg-gradient-to-r from-amber-500 via-orange-500 to-yellow-600 opacity-20 rounded-2xl -m-1"></div>
                <div class="relative z-10">
                    <div class="flex items-center">
                        <div class="p-3 bg-amber-100 rounded-xl">
                            <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Deposits</p>
<p class="text-2xl font-bold text-gray-900">₱{{ number_format($totalDeposits ?? 0, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 shadow-xl border border-white/50 hover:shadow-2xl transition-all duration-300">
                <div class="absolute inset-0 bg-gradient-to-r from-purple-500 via-pink-500 to-rose-600 opacity-20 rounded-2xl -m-1"></div>
                <div class="relative z-10">
                    <div class="flex items-center">
                        <div class="p-3 bg-purple-100 rounded-xl">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Uploads</p>
                            <p class="text-3xl font-bold text-gray-900">{{ number_format($totalUploads ?? 0) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 shadow-xl border border-white/50">
            <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-purple-600 opacity-10 rounded-2xl -m-1"></div>
            <div class="relative z-10">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Monthly Amount Trend</h3>
                <canvas id="monthlyChart" height="100"></canvas>
            </div>
        </div>

        <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 shadow-xl border border-white/50">
            <div class="absolute inset-0 bg-gradient-to-r from-green-500 to-emerald-600 opacity-10 rounded-2xl -m-1"></div>
            <div class="relative z-10">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Records by Category</h3>
                <canvas id="recordsChart" height="100"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Records -->
    <div class="bg-white/80 backdrop-blur-md rounded-2xl shadow-xl border border-white/50 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-purple-600 opacity-10 rounded-2xl -m-1"></div>
        <div class="relative z-10">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-xl font-bold text-gray-900">Recent Records</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($recentRecords ?? [] as $record)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $record->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">₱{{ number_format($record->amount, 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $record->date->format('M d, Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-12 text-center text-gray-500">No records yet. Import some Excel data!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Monthly Chart
    const ctx1 = document.getElementById('monthlyChart').getContext('2d');
    new Chart(ctx1, {
        type: 'line',
        data: @json($chartData ?? []),
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Records Chart
    const ctx2 = document.getElementById('recordsChart').getContext('2d');
    new Chart(ctx2, {
        type: 'doughnut',
        data: @json($recordsChartData ?? []),
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom' } }
        }
    });
</script>
@endpush>
@endsection

