@extends('layouts.dashboard')

@section('title', 'New Record')

@section('content')
<div class="space-y-6">
    <div class="flex items-center">
        <a href="{{ route('records.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 p-3 -m-3 rounded-lg transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Records
        </a>
    </div>

    <div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-2xl border border-white/50 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-500 to-green-600 opacity-10 rounded-3xl -m-1"></div>
        <div class="relative z-10 p-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Add New Record</h2>
            
            <form method="POST" action="{{ route('records.store') }}" class="space-y-6 max-w-md mx-auto">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required 
                           class="w-full px-5 py-4 border border-gray-300 rounded-2xl focus:ring-4 focus:ring-emerald-200 focus:border-emerald-500 shadow-lg transition-all duration-300 @error('name') border-red-300 ring-2 ring-red-200 @enderror"
                           placeholder="e.g. Monthly Salary, Grocery Shopping">
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Amount</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="text-lg font-bold text-green-600">$</span>
                        </div>
                        <input type="number" name="amount" step="0.01" min="0" value="{{ old('amount') }}" required
                               class="w-full pl-12 pr-5 py-4 border border-gray-300 rounded-2xl focus:ring-4 focus:ring-emerald-200 focus:border-emerald-500 shadow-lg transition-all duration-300 @error('amount') border-red-300 ring-2 ring-red-200 @enderror"
                               placeholder="0.00">
                    </div>
                    @error('amount')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Date</label>
                    <input type="date" name="date" value="{{ old('date') ?: \Carbon\Carbon::today()->format('Y-m-d') }}" required
                           class="w-full px-5 py-4 border border-gray-300 rounded-2xl focus:ring-4 focus:ring-emerald-200 focus:border-emerald-500 shadow-lg transition-all duration-300 @error('date') border-red-300 ring-2 ring-red-200 @enderror">
                    @error('date')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="submit" class="flex-1 bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700 text-white font-bold py-5 px-8 rounded-2xl shadow-2xl hover:shadow-3xl hover:-translate-y-1 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-emerald-300">
                        <svg class="w-6 h-6 mr-3 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Save Record
                    </button>
                    <a href="{{ route('records.index') }}" class="flex-1 text-center bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white font-bold py-5 px-8 rounded-2xl shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

