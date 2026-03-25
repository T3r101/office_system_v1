@extends('layouts.dashboard')

@section('title', 'Records')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Records</h1>
            <p class="text-gray-600 mt-1">{{ $records->total() }} total records</p>
        </div>
        <a href="{{ route('records.create') }}" class="bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white px-8 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300">
            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Add Record
        </a>
    </div>

    <!-- Compact Date Range Filter -->
    <div class="bg-white/80 backdrop-blur-md rounded-2xl p-4 shadow-lg border border-white/50">
        <form method="GET" action="{{ route('records.index') }}" class="flex flex-wrap gap-3 items-end">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-xs font-medium text-gray-700 mb-1">From</label>
                <input type="date" name="date_from" value="{{ request('date_from') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm shadow-sm transition-all">
            </div>
            <div class="flex-1 min-w-[200px]">
                <label class="block text-xs font-medium text-gray-700 mb-1">To</label>
                <input type="date" name="date_to" value="{{ request('date_to') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm shadow-sm transition-all">
            </div>
            <button type="submit" class="px-6 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white rounded-lg font-medium shadow-lg hover:shadow-xl transition-all whitespace-nowrap text-sm">
                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                Filter
            </button>
            @if(request('date_from') || request('date_to'))
                <a href="{{ route('records.index') }}" class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 font-medium transition-all whitespace-nowrap text-sm">
                    Clear
                </a>
            @endif
            <input type="hidden" name="page" value="1">
        </form>
    </div>

    <!-- Records Table -->
    <div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-2xl border border-white/50 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-purple-600 opacity-10 rounded-3xl -m-1"></div>
        <div class="relative z-10 overflow-x-auto">
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                    <tr>
                        <th class="px-6 py-5 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-5 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-5 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-5 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Created</th>
                        <th class="px-6 py-5 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($records as $record)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-5 whitespace-nowrap font-medium text-gray-900">
                                {{ $record->name }}
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap text-right">
                                <span class="text-2xl font-bold text-green-600">${{ number_format($record->amount, 2) }}</span>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-900">
                                {{ $record->date->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-500">
                                {{ $record->created_at->diffForHumans() }}
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap text-center text-sm font-medium">
                                <div class="flex items-center justify-center space-x-2">
@if(auth()->user()->role === 'admin')
                                        <a href="{{ route('admin.records.edit', $record) }}" class="px-3 py-2 bg-gradient-to-r from-blue-600/90 to-blue-700/90 hover:from-blue-700/95 hover:to-blue-800/95 text-white font-medium rounded-xl transition-all shadow-lg hover:shadow-xl hover:scale-105 active:scale-95 inline-flex items-center text-sm">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Edit
                                        </a>
                                    @endif
                                    <form method="POST" action="{{ route('records.destroy', $record) }}" class="inline" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-2 bg-gradient-to-r from-red-600/90 to-red-700/90 hover:from-red-700/95 hover:to-red-800/95 text-white font-medium rounded-xl transition-all shadow-lg hover:shadow-xl hover:scale-105 active:scale-95 text-sm inline-flex items-center" onclick="return confirm('Delete this record?')">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-20 text-center">
                                <div class="text-gray-500 space-y-4">
                                    <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012 2m0 0h2a2 2 0 012 2v4m-4-6h4m0 0v4m0-4V6"></path>
                                    </svg>
                                    <div>
                                        <h3 class="text-lg font-medium text-gray-900 mb-1">No records yet</h3>
                                        <p class="text-gray-500">Get started by importing Excel data or adding your first record.</p>
                                    </div>
                                    <div class="flex justify-center space-x-3">
                                        <a href="{{ route('import.excel') }}" class="bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white px-6 py-3 rounded-xl font-medium shadow-lg hover:shadow-xl transition-all">
                                            Import Excel
                                        </a>
                                        <a href="{{ route('records.create') }}" class="bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white px-6 py-3 rounded-xl font-medium shadow-lg hover:shadow-xl transition-all">
                                            Add Manual
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($records->hasPages())
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                {{ $records->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

