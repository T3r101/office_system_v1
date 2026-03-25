@extends('layouts.dashboard')

@section('title', 'New Deposit')

@section('content')
<div class="max-w-lg mx-auto">
    <div class="text-center mb-12">
        <div class="inline-flex items-center px-6 py-4 bg-gradient-to-r from-amber-500 to-orange-600 text-white rounded-3xl shadow-2xl mb-6">
            <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08 .402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
            </svg>
            <div>
                <h1 class="text-3xl font-bold">New Deposit</h1>
                <p class="opacity-90">Record cash deposit or top-up</p>
            </div>
        </div>
    </div>

    <div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-2xl border border-white/50 p-10">
        <div class="absolute inset-0 bg-gradient-to-r from-amber-500 to-orange-600 opacity-20 rounded-3xl -m-1"></div>
        <div class="relative z-10">
            <form method="POST" action="{{ route('deposits.store') }}" class="space-y-6">
                @csrf
                <div>
                    <label for="date" class="block text-sm font-bold text-gray-700 mb-3">Deposit Date</label>
                    <input type="date" name="date" id="date" value="{{ old('date') }}" required
                           class="w-full px-6 py-4 border-2 border-dashed border-gray-300 rounded-2xl text-gray-700 bg-white/50 backdrop-blur-sm hover:border-amber-400 hover:bg-amber-50 focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all shadow-lg">
                    @error('date')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="amount" class="block text-sm font-bold text-gray-700 mb-3">Amount</label>
                    <input type="number" name="amount" id="amount" value="{{ old('amount') }}" step="0.01" min="0" required
                           class="w-full px-6 py-4 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all shadow-sm text-right text-2xl font-bold text-gray-900">
                    @error('amount')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="source" class="block text-sm font-bold text-gray-700 mb-3">Source</label>
                    <input type="text" name="source" id="source" value="{{ old('source') }}"
                           placeholder="e.g. Cash deposit, Bank transfer, Client payment"
                           class="w-full px-6 py-4 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all shadow-sm">
                    @error('source')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="notes" class="block text-sm font-bold text-gray-700 mb-3">Notes (Optional)</label>
                    <textarea name="notes" id="notes" rows="3" placeholder="Additional details..."
                              class="w-full px-6 py-4 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all shadow-sm resize-vertical">{{ old('notes') }}</textarea>
                    @error('notes')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center space-x-4 pt-8 border-t border-gray-200">
                    <a href="{{ route('deposits.index') }}" class="flex-1 text-center bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white font-bold py-5 px-8 rounded-2xl shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                        Cancel
                    </a>
                    <button type="submit" class="flex-1 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white font-bold py-5 px-8 rounded-2xl shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                        <svg class="w-6 h-6 inline mr-3" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Record Deposit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

