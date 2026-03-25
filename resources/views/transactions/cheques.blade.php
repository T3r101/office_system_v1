@extends('layouts.dashboard')

@section('title', 'Cheque Management')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-4xl font-bold text-gray-900">Cheque Management</h1>
            <p class="text-xl text-gray-600 mt-2">Record and track cheque payments</p>
        </div>
        <button onclick="openMultipleModal()" class="px-8 py-4 bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white font-bold text-lg rounded-2xl shadow-xl hover:shadow-2xl transition-all">
            Multiple Check Entry
        </button>
    </div>

    <!-- Cheque Form -->
    <div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-2xl border border-white/50 p-8 lg:p-12">
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-400 to-teal-500 opacity-10 rounded-3xl -m-px"></div>
        <div class="relative z-10">
            <h2 class="text-2xl font-bold text-gray-900 mb-8">New Cheque Entry</h2>
            <form id="chequeForm" class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                @csrf
                <div>
                    <label for="check_number" class="block text-sm font-bold text-gray-700 mb-3">Check Number *</label>
                    <input type="text" name="check_number" id="check_number" required
                           class="w-full px-6 py-4 border-2 border-gray-300 rounded-2xl focus:ring-4 focus:ring-emerald-500/30 focus:border-emerald-500 shadow-lg transition-all uppercase">
                </div>

                <div>
                    <label for="payee_name" class="block text-sm font-bold text-gray-700 mb-3">Name of Payee *</label>
                    <input type="text" name="payee_name" id="payee_name" required
                           class="w-full px-6 py-4 border-2 border-gray-300 rounded-2xl focus:ring-4 focus:ring-emerald-500/30 focus:border-emerald-500 shadow-lg transition-all">
                </div>

                <div>
                    <label for="nature_of_payment" class="block text-sm font-bold text-gray-700 mb-3">Nature of Payment *</label>
                    <input type="text" name="nature_of_payment" id="nature_of_payment" required
                           class="w-full px-6 py-4 border-2 border-gray-300 rounded-2xl focus:ring-4 focus:ring-emerald-500/30 focus:border-emerald-500 shadow-lg transition-all">
                </div>

                <div>
                    <label for="office" class="block text-sm font-bold text-gray-700 mb-3">Office *</label>
                    <input type="text" name="office" id="office" required
                           class="w-full px-6 py-4 border-2 border-gray-300 rounded-2xl focus:ring-4 focus:ring-emerald-500/30 focus:border-emerald-500 shadow-lg transition-all">
                </div>

                <div>
                    <label for="account_code" class="block text-sm font-bold text-gray-700 mb-3">Account Code *</label>
                    <input type="text" name="account_code" id="account_code" required
                           class="w-full px-6 py-4 border-2 border-gray-300 rounded-2xl focus:ring-4 focus:ring-emerald-500/30 focus:border-emerald-500 shadow-lg transition-all">
                </div>

                <div>
                    <label for="specific_fund" class="block text-sm font-bold text-gray-700 mb-3">Specific Fund *</label>
                    <select name="specific_fund" id="specific_fund" required
                            class="w-full px-6 py-4 border-2 border-gray-300 rounded-2xl focus:ring-4 focus:ring-emerald-500/30 focus:border-emerald-500 shadow-lg transition-all">
                        <option value="">Select Fund</option>
                        <option value="General Fund">General Fund</option>
                        <option value="Special Fund">Special Fund</option>
                        <option value="Capital Fund">Capital Fund</option>
                        <option value="Trust Fund">Trust Fund</option>
                    </select>
                </div>

                <div>
                    <label for="type" class="block text-sm font-bold text-gray-700 mb-3">Current/Prior *</label>
                    <select name="type" id="type" required
                            class="w-full px-6 py-4 border-2 border-gray-300 rounded-2xl focus:ring-4 focus:ring-emerald-500/30 focus:border-emerald-500 shadow-lg transition-all">
                        <option value="">Select Type</option>
                        <option value="current">Current</option>
                        <option value="prior">Prior</option>
                        <option value="continuing">Continuing</option>
                    </select>
                </div>

                <div>
                    <label for="amount" class="block text-sm font-bold text-gray-700 mb-3">Amount of Check Issued *</label>
                    <input type="number" name="amount" id="amount" step="0.01" min="0.01" required
                           class="w-full px-6 py-4 border-2 border-gray-300 rounded-2xl focus:ring-4 focus:ring-emerald-500/30 focus:border-emerald-500 text-right text-2xl font-bold shadow-lg transition-all">
                </div>

                <div class="lg:col-span-2">
                    <label for="cheque_date" class="block text-sm font-bold text-gray-700 mb-3">Date *</label>
                    <input type="datetime-local" name="cheque_date" id="cheque_date" required
                           class="w-full px-6 py-4 border-2 border-gray-300 rounded-2xl focus:ring-4 focus:ring-emerald-500/30 focus:border-emerald-500 shadow-lg transition-all">
                </div>

                <div class="lg:col-span-2 flex justify-end">
                    <button type="submit" id="submitBtn" class="px-16 py-6 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-bold text-xl rounded-3xl shadow-2xl hover:shadow-3xl hover:-translate-y-1 transition-all duration-300 uppercase tracking-wide">
                        <svg class="w-7 h-7 inline mr-3" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        SAVE
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Search -->
    <div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-2xl border border-white/50 p-6">
        <div class="flex items-center gap-4">
            <h2 class="text-2xl font-bold text-gray-900 flex-1">Recent Cheques</h2>
            <div class="relative flex-1 max-w-md">
                <input type="text" id="searchInput" placeholder="Search Cheque Number..." 
                       class="w-full pl-12 pr-6 py-4 border-2 border-gray-300 rounded-2xl focus:ring-4 focus:ring-emerald-500/30 focus:border-emerald-500 shadow-lg transition-all">
                <svg class="w-5 h-5 absolute left-5 top-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Cheques Table -->
    <div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-2xl border border-white/50 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-400 to-teal-500 opacity-5 rounded-3xl -m-px"></div>
        <div class="relative z-10 overflow-x-auto">
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                    <tr>
                        <th class="px-6 py-5 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-5 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Check Number</th>
                        <th class="px-6 py-5 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Name of Payee</th>
                        <th class="px-6 py-5 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Nature</th>
                        <th class="px-6 py-5 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-5 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Office</th>
                        <th class="px-6 py-5 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Account Code</th>
                        <th class="px-6 py-5 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Fund</th>
                    </tr>
                </thead>
                <tbody id="chequesTableBody" class="divide-y divide-gray-200">
                    <!-- AJAX populated -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Messages -->
    <div id="messageContainer" class="fixed top-24 right-6 z-50 space-y-2"></div>

    <!-- Multiple Entry Modal -->
    <div id="multipleModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-6">
        <div class="bg-white/95 backdrop-blur-md rounded-3xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-8 border-b border-gray-200">
                <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                    Multiple Check Entry
                    <button onclick="closeMultipleModal()" class="ml-auto p-2 hover:bg-gray-200 rounded-xl transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </h2>
            </div>
            <div class="p-8">
                <p class="text-gray-600 mb-6">Coming soon - batch cheque entry feature</p>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    loadCheques();

    document.getElementById('chequeForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const submitBtn = document.getElementById('submitBtn');
        const originalText = submitBtn.innerHTML;
        
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<svg class="w-7 h-7 animate-spin mr-3" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Saving...';

        try {
            const response = await fetch('{{ route("cheques.store") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();

            if (data.success) {
                showMessage('Cheque saved successfully!', 'success');
                this.reset();
                loadCheques();
            } else {
                showMessage(data.message || 'Error saving cheque', 'error');
            }
        } catch (error) {
            showMessage('Network error. Please try again.', 'error');
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        }
    });

    // Search
    document.getElementById('searchInput').addEventListener('input', debounce(function() {
        loadCheques(this.value);
    }, 300));
});

async function loadCheques(search = '') {
    const url = search 
        ? `{{ route('cheques.search', '') }}?q=${encodeURIComponent(search)}`
        : '{{ route('cheques.fetch') }}';

    try {
        const response = await fetch(url);
        const cheques = await response.json();

        const tbody = document.getElementById('chequesTableBody');
        tbody.innerHTML = '';

        cheques.forEach(cheque => {
            const row = document.createElement('tr');
            row.className = 'hover:bg-gray-50 transition-colors';
            row.innerHTML = `
                <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-900">
                    ${new Date(cheque.cheque_date).toLocaleString('en-US', { year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' })}
                </td>
                <td class="px-6 py-5 whitespace-nowrap font-bold text-emerald-700">${cheque.check_number}</td>
                <td class="px-6 py-5 whitespace-nowrap text-sm font-medium text-gray-900">${cheque.payee_name}</td>
                <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-900">${cheque.nature_of_payment}</td>
                <td class="px-6 py-5 whitespace-nowrap text-right">
                    <span class="text-xl font-bold text-emerald-600">${parseFloat(cheque.amount).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</span>
                </td>
                <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-900">${cheque.office}</td>
                <td class="px-6 py-5 whitespace-nowrap text-sm font-mono bg-gray-100 px-3 py-1 rounded-lg">${cheque.account_code}</td>
                <td class="px-6 py-5 whitespace-nowrap">
                    <span class="inline-flex px-3 py-1 text-xs font-bold rounded-full bg-emerald-100 text-emerald-800">${cheque.specific_fund}</span>
                </td>
            `;
            tbody.appendChild(row);
        });

        if (cheques.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="8" class="px-6 py-20 text-center text-gray-500">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-1">No cheques recorded</h3>
                        <p class="text-gray-500">Get started by adding your first cheque above.</p>
                    </td>
                </tr>
            `;
        }
    } catch (error) {
        console.error('Error loading cheques:', error);
    }
}

function showMessage(message, type) {
    const container = document.getElementById('messageContainer');
    const alert = document.createElement('div');
    alert.className = `p-4 rounded-2xl shadow-2xl mb-4 animate-in slide-in-from-right fade-in ${type === 'success' ? 'bg-emerald-500 text-white' : 'bg-red-500 text-white'}`;
    alert.innerHTML = `
        <div class="flex items-center">
            <svg class="w-6 h-6 mr-3 ${type === 'success' ? 'text-emerald-300' : 'text-red-300'}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                ${type === 'success' ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>' : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>'}
            </svg>
            <span>${message}</span>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-auto p-1 hover:bg-opacity-20 hover:bg-white rounded-full">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    `;
    container.appendChild(alert);
    
    setTimeout(() => {
        alert.style.animation = 'slide-out-to-right 0.3s ease-out forwards';
        setTimeout(() => alert.remove(), 300);
    }, 4000);
}

function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

function openMultipleModal() {
    document.getElementById('multipleModal').classList.remove('hidden');
}

function closeMultipleModal() {
    document.getElementById('multipleModal').classList.add('hidden');
}
</script>
@endsection

