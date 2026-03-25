@extends('layouts.dashboard')

@section('title', 'Deposit Management')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">
    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
        <div>
            <h1 class="text-4xl font-bold text-gray-900">Deposit Management</h1>
            <p class="text-xl text-gray-600 mt-2">Total Deposits: <span class="font-bold text-amber-600">${{ number_format($totalDeposits ?? 0, 2) }}</span></p>
        </div>
    </div>

    <!-- Deposit Form -->
    <div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-2xl border border-white/50 p-8 lg:p-12">
        <div class="absolute inset-0 bg-gradient-to-br from-amber-400 to-orange-500 opacity-10 rounded-3xl -m-px"></div>
        <div class="relative z-10">
            <h2 class="text-2xl font-bold text-gray-900 mb-8">New Deposit Entry</h2>
            <form id="depositForm" class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                @csrf
                <div>
                    <label for="amount" class="block text-sm font-bold text-gray-700 mb-3">Amount of Deposit *</label>
                    <input type="number" name="amount" id="amount" step="0.01" min="0.01" required
                           class="w-full px-6 py-4 border-2 border-gray-300 rounded-2xl focus:ring-4 focus:ring-amber-500/30 focus:border-amber-500 text-right text-2xl font-bold shadow-lg transition-all">
                    @error('amount')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="payee_name" class="block text-sm font-bold text-gray-700 mb-3">Name of Payee *</label>
                    <input type="text" name="payee_name" id="payee_name" required
                           class="w-full px-6 py-4 border-2 border-gray-300 rounded-2xl focus:ring-4 focus:ring-amber-500/30 focus:border-amber-500 shadow-lg transition-all">
                    @error('payee_name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="nature_of_payment" class="block text-sm font-bold text-gray-700 mb-3">Nature of Payment *</label>
                    <input type="text" name="nature_of_payment" id="nature_of_payment" required
                           class="w-full px-6 py-4 border-2 border-gray-300 rounded-2xl focus:ring-4 focus:ring-amber-500/30 focus:border-amber-500 shadow-lg transition-all">
                    @error('nature_of_payment')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="cheque_number" class="block text-sm font-bold text-gray-700 mb-3">Cheque Number</label>
                    <input type="text" name="cheque_number" id="cheque_number"
                           class="w-full px-6 py-4 border-2 border-gray-300 rounded-2xl focus:ring-4 focus:ring-amber-500/30 focus:border-amber-500 shadow-lg transition-all">
                    @error('cheque_number')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="specific_fund" class="block text-sm font-bold text-gray-700 mb-3">Specific Fund *</label>
                    <select name="specific_fund" id="specific_fund" required
                            class="w-full px-6 py-4 border-2 border-gray-300 rounded-2xl focus:ring-4 focus:ring-amber-500/30 focus:border-amber-500 shadow-lg transition-all">
                        <option value="">Select Fund</option>
                        <option value="General Fund" {{ old('specific_fund') == 'General Fund' ? 'selected' : '' }}>General Fund</option>
                        <option value="Special Fund" {{ old('specific_fund') == 'Special Fund' ? 'selected' : '' }}>Special Fund</option>
                        <option value="Capital Fund" {{ old('specific_fund') == 'Capital Fund' ? 'selected' : '' }}>Capital Fund</option>
                        <option value="Trust Fund" {{ old('specific_fund') == 'Trust Fund' ? 'selected' : '' }}>Trust Fund</option>
                    </select>
                    @error('specific_fund')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="lg:col-span-2">
                    <label for="deposit_date" class="block text-sm font-bold text-gray-700 mb-3">Date of Deposit *</label>
                    <input type="datetime-local" name="deposit_date" id="deposit_date" required
                           class="w-full px-6 py-4 border-2 border-gray-300 rounded-2xl focus:ring-4 focus:ring-amber-500/30 focus:border-amber-500 shadow-lg transition-all">
                    @error('deposit_date')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="lg:col-span-2 flex justify-end">
                    <button type="submit" id="submitBtn" class="px-12 py-6 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white font-bold text-xl rounded-3xl shadow-2xl hover:shadow-3xl hover:-translate-y-1 hover:scale-[1.02] transition-all duration-300 uppercase tracking-wide">
                        <svg class="w-6 h-6 inline mr-3" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Deposit Amount
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Deposits Table -->
    <div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-2xl border border-white/50 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-amber-400 to-orange-500 opacity-5 rounded-3xl -m-px"></div>
        <div class="relative z-10">
            <div class="p-8 border-b border-gray-200">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Recent Deposits</h2>
                <p class="text-gray-600">Latest 50 deposits (sorted by date)</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                        <tr>
                            <th class="px-6 py-5 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Date of Deposit</th>
                            <th class="px-6 py-5 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Name of Payee</th>
                            <th class="px-6 py-5 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Nature of Payment</th>
                            <th class="px-6 py-5 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Cheque Number</th>
                            <th class="px-6 py-5 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">Amount Deposited</th>
                            <th class="px-6 py-5 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Specific Fund</th>
                        </tr>
                    </thead>
                    <tbody id="depositsTableBody" class="divide-y divide-gray-200">
                        <!-- AJAX populated -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    <div id="messageContainer" class="fixed top-24 right-6 z-50"></div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    loadDeposits();

    document.getElementById('depositForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const submitBtn = document.getElementById('submitBtn');
        const originalText = submitBtn.innerHTML;
        
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<svg class="w-6 h-6 animate-spin mr-3" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Saving...';

        try {
            const response = await fetch('{{ route("deposits.store") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();

            if (data.success) {
                showMessage('Deposit added successfully!', 'success');
                this.reset();
                loadDeposits();
            } else {
                showMessage(data.message || 'Error saving deposit', 'error');
            }
        } catch (error) {
            showMessage('Network error. Please try again.', 'error');
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        }
    });
});

async function loadDeposits() {
    try {
        const response = await fetch('{{ route("deposits.fetch") }}');
        const deposits = await response.json();

        const tbody = document.getElementById('depositsTableBody');
        tbody.innerHTML = '';

        deposits.forEach(deposit => {
            const row = document.createElement('tr');
            row.className = 'hover:bg-gray-50 transition-colors';
            row.innerHTML = `
                <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-900">
                    ${new Date(deposit.deposit_date).toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' })}
                </td>
                <td class="px-6 py-5 whitespace-nowrap text-sm font-medium text-gray-900">${deposit.payee_name}</td>
                <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-900">${deposit.nature_of_payment}</td>
                <td class="px-6 py-5 whitespace-nowrap text-sm font-medium text-gray-900">${deposit.cheque_number || '-'}</td>
                <td class="px-6 py-5 whitespace-nowrap text-right">
                    <span class="text-2xl font-bold text-amber-600">${parseFloat(deposit.amount).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</span>
                </td>
                <td class="px-6 py-5 whitespace-nowrap">
                    <span class="inline-flex px-3 py-1 text-xs font-bold rounded-full bg-amber-100 text-amber-800">${deposit.specific_fund}</span>
                </td>
            `;
            tbody.appendChild(row);
        });

        if (deposits.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="6" class="px-6 py-20 text-center text-gray-500">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08 .402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-1">No deposits yet</h3>
                        <p class="text-gray-500">Start by adding your first deposit above.</p>
                    </td>
                </tr>
            `;
        }
    } catch (error) {
        console.error('Error loading deposits:', error);
    }
}

function showMessage(message, type) {
    const container = document.getElementById('messageContainer');
    const alert = document.createElement('div');
    alert.className = `p-4 rounded-2xl shadow-2xl mb-4 transform transition-all duration-300 ${type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'}`;
    alert.innerHTML = `
        <div class="flex items-center">
            <svg class="w-6 h-6 mr-3 ${type === 'success' ? 'text-green-300' : 'text-red-300'}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                ${type === 'success' ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>' : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>'}
            </svg>
            <span>${message}</span>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-auto p-1 hover:bg-opacity-20 hover:bg-white rounded-full transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    `;
    container.appendChild(alert);
    
    setTimeout(() => {
        alert.classList.add('translate-x-8', 'opacity-0');
        setTimeout(() => alert.remove(), 300);
    }, 4000);
}
</script>
@endsection

