@extends('layouts.dashboard')

@section('title', 'Transactions List')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold text-gray-900">Transactions List</h1>
                <p class="text-xl text-gray-600 mt-2">All your transactions</p>
            </div>
            <a href="{{ route('transactions.index') }}" class="px-8 py-4 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-bold rounded-2xl shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                New Transaction
            </a>
        </div>
    </div>

    <div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-2xl border border-white/50 overflow-hidden">
        <div class="p-8">
            <div class="flex items-center gap-4 mb-6">
                <input type="text" id="searchTransactions" placeholder="Search transactions..." class="flex-1 px-6 py-4 border-2 border-gray-300 rounded-2xl focus:ring-4 focus:ring-emerald-500/30 focus:border-emerald-500 shadow-lg transition-all">
                <button id="refreshTransactions" class="px-8 py-4 bg-gradient-to-r from-slate-600 to-slate-700 hover:from-slate-700 hover:to-slate-800 text-white rounded-2xl shadow-lg hover:shadow-xl transition-all font-medium">
                    Refresh
                </button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                    <tr>
                        <th class="px-6 py-5 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-5 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Check No</th>
                        <th class="px-6 py-5 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Payee</th>
                        <th class="px-6 py-5 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Nature</th>
                        <th class="px-6 py-5 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-5 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Office</th>
                        <th class="px-6 py-5 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody id="transactionsListBody">
                    <!-- Data loaded via AJAX -->
                </tbody>
            </table>
        </div>
        <div id="transactionsPagination" class="bg-gray-50 px-8 py-6 border-t">
            <!-- Pagination loaded via AJAX -->
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    loadTransactionsList();
    
    document.getElementById('searchTransactions').addEventListener('input', debounce(function() {
        loadTransactionsList();
    }, 300));
    
    document.getElementById('refreshTransactions').addEventListener('click', loadTransactionsList);
});

async function loadTransactionsList() {
    const search = document.getElementById('searchTransactions').value;
    const tbody = document.getElementById('transactionsListBody');
    
    try {
        const response = await fetch(`/transactions/list?q=${encodeURIComponent(search)}`);
        const data = await response.json();
        
        tbody.innerHTML = data.data.map(transaction => `
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-5 whitespace-nowrap text-sm font-medium text-gray-900">
                    ${new Date(transaction.date).toLocaleString()}
                </td>
                <td class="px-6 py-5 whitespace-nowrap">
                    <span class="bg-emerald-100 text-emerald-800 px-3 py-1 rounded-full text-sm font-bold">
                        ${transaction.check_no}
                    </span>
                </td>
                <td class="px-6 py-5 whitespace-nowrap text-sm font-medium text-gray-900">${transaction.payee_name}</td>
                <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-900 truncate max-w-[200px]">${transaction.nature_of_payment}</td>
                <td class="px-6 py-5 whitespace-nowrap text-right">
                    <span class="text-xl font-bold text-emerald-600">₱${parseFloat(transaction.amount).toLocaleString('en-PH', {minimumFractionDigits: 2})}</span>
                </td>
                <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-900">${transaction.office}</td>
                <td class="px-6 py-5 whitespace-nowrap text-sm font-medium">
                    <div class="flex items-center gap-2">
                        <button onclick="editTransaction(${transaction.id})" class="text-emerald-600 hover:text-emerald-900">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </button>
                        <button onclick="deleteTransaction(${transaction.id})" class="text-red-600 hover:text-red-900">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                </td>
            </tr>
        `).join('') || `
            <tr>
                <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-1">No transactions found</h3>
                    <p class="text-sm">Try adjusting your search terms</p>
                </td>
            </tr>
        `;
        
        // Update pagination
        document.getElementById('transactionsPagination').innerHTML = data.links.map(link => `
            <a href="#" data-page="${link.url ? link.url.split('page=')[1] : 1}" class="px-4 py-2 bg-white border rounded-lg hover:bg-gray-100 ${link.active ? 'bg-emerald-500 text-white' : ''}">
                ${link.label}
            </a>
        `).join(' ');
    } catch (error) {
        console.error('Error:', error);
    }
}

function debounce(func, wait) {
    let timeout;
    return function() {
        clearTimeout(timeout);
        timeout = setTimeout(func, wait);
    };
}
</script>
@endsection
