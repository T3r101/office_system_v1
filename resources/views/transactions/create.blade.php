@extends('layouts.dashboard')

@section('title', 'New Transaction')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="text-center mb-12">
        <div class="inline-flex items-center px-6 py-4 bg-gradient-to-r from-emerald-500 to-teal-600 text-white rounded-3xl shadow-2xl mb-6">
            <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            <div>
                <h1 class="text-3xl font-bold">New Transaction</h1>
                <p class="opacity-90">Add manual transaction record</p>
            </div>
        </div>
    </div>

    <div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-2xl border border-white/50 p-12">
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-500 to-teal-600 opacity-20 rounded-3xl -m-1"></div>
        <div class="relative z-10">
            <form method="POST" action="{{ route('transactions.store') }}" class="space-y-8">
                @csrf
                <div>
                    <label for="date" class="block text-sm font-bold text-gray-700 mb-3">Transaction Date</label>
                    <input type="date" name="date" id="date" value="{{ old('date') }}" required
                           class="w-full px-6 py-4 border-2 border-dashed border-gray-300 rounded-2xl text-gray-700 bg-white/50 backdrop-blur-sm hover:border-emerald-400 hover:bg-emerald-50 focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all shadow-lg">
                    @error('date')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="category" class="block text-sm font-bold text-gray-700 mb-3">Category (Optional)</label>
                    <input type="text" name="category" id="category" value="{{ old('category') }}"
                           class="w-full px-6 py-4 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all shadow-sm">
                    @error('category')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-bold text-gray-700 mb-3">Description</label>
                    <input type="text" name="description" id="description" value="{{ old('description') }}" required
                           placeholder="e.g. Salary payment, Office supplies"
                           class="w-full px-6 py-4 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all shadow-sm">
                    @error('description')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="amount" class="block text-sm font-bold text-gray-700 mb-3">Amount</label>
                    <input type="number" name="amount" id="amount" value="{{ old('amount') }}" step="0.01" min="0" required
                           placeholder="0.00"
                           class="w-full px-6 py-4 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all shadow-sm text-right text-2xl font-bold text-gray-900">
                    @error('amount')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="type" class="block text-sm font-bold text-gray-700 mb-3">Type</label>
                    <select name="type" id="type" required class="w-full px-6 py-4 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all shadow-sm">
                        <option value="">Select type</option>
                        <option value="income" {{ old('type') == 'income' ? 'selected' : '' }}>Income</option>
                        <option value="expense" {{ old('type') == 'expense' ? 'selected' : '' }}>Expense</option>
                    </select>
                    @error('type')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center space-x-4 pt-8 border-t border-gray-200">
                    <a href="{{ route('records.index') }}" class="flex-1 text-center bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white font-bold py-5 px-8 rounded-2xl shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                        Cancel
                    </a>
                    <button type="submit" class="flex-1 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-bold py-5 px-8 rounded-2xl shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                        <svg class="w-6 h-6 inline mr-3" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Add Transaction
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

