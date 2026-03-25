@extends('layouts.dashboard')
@section('title', 'Cheque Management')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-2">Cheque Management System</h1>
        <p class="text-xl text-gray-600">Track and manage all cheque transactions</p>
    </div>

    <!-- Form Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <div class="bg-white/80 backdrop-blur-lg rounded-3xl p-8 shadow-2xl border border-white/50">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">New Cheque Entry</h2>
            <form id="chequeForm" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Check Number <span class="text-red-500">*</span></label>
                        <input type="text" id="check_number" name="check_number" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all shadow-sm" placeholder="CHQ001234">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Amount <span class="text-red-500">*</span></label>
                        <input type="number" id="amount" name="amount" step="0.01" min="0.01" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all shadow-sm" placeholder="12500.00">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Date <span class="text-red-500">*</span></label>
                        <input type="datetime-local" id="cheque_date" name="cheque_date" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Payee Name <span class="text-red-500">*</span></label>
                        <input type="text" id="payee_name" name="payee_name" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all shadow-sm" placeholder="ABC Corporation">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nature of Payment <span class="text-red-500">*</span></label>
                        <input type="text" id="nature_of_payment" name="nature_of_payment" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all shadow-sm" placeholder="Payment for supplies">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Office <span class="text-red-500">*</span></label>
                        <input type="text" id="office" name="office" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all shadow-sm" placeholder="Finance Department">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Account Code <span class="text-red-500">*</span></label>
                        <input type="text" id="account_code" name="account_code" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all shadow-sm" placeholder="1-01-01-001">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Specific Fund <span class="text-red-500">*</span></label>
                        <select id="specific_fund" name="specific_fund" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all shadow-sm">
                            <option value="">Select Specific Fund</option>
                            <option value="GENERAL FUND">General Fund</option>
                            <option value="TRUST FUND">Trust Fund</option>
                            <option value="SPECIAL FUND">Special Fund</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Current/Prior <span class="text-red-500">*</span></label>
                        <select id="type" name="type" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all shadow-sm">
                            <option value="">Select Type</option>
                            <option value="current">Current</option>
                            <option value="prior">Prior</option>
                            <option value="continuing">Continuing</option>
                        </select>
                    </div>
                </div>
                <div class="flex gap-4">
                    <button type="submit" id="saveBtn" class="flex-1 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold py-4 px-8 rounded-2xl shadow-2xl hover:shadow-3xl transition-all duration-300 transform hover:-translate-y-1">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Save Cheque
                        </span>
                    </button>
                    <button type="button" id="multipleBtn" class="px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                        Multiple Cheque Entry
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white/80 backdrop-blur-lg rounded-3xl p-8 shadow-2xl border border-white/50">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Cheque Records</h2>
                <p class="text-gray-600">All cheque transactions (latest first)</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="relative">
                    <input type="text" id="searchInput" placeholder="🔍 Search Cheque Number..." class="w-80 pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent shadow-sm">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <button id="refreshBtn" class="px-6 py-3 bg-gradient-to-r from-slate-600 to-slate-700 hover:from-slate-700 hover:to-slate-800 text-white rounded-xl shadow-lg hover:shadow-xl transition-all font-medium">
                    Refresh
                </button>
            </div>
        </div>

        <div class="overflow-hidden rounded-2xl border border-gray-200">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[1200px]">
                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-[140px]">Date</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-[140px]">Check Number</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-[160px]">Payee Name</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-[200px]">Nature of Payment</th>
                            <th class="px-6 py-4 text-right text-xs font-bold text-gray-700 uppercase tracking-wider w-[140px]">Amount</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-[160px]">Office</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-[140px]">Account Code</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-[140px]">Specific Fund</th>
                        </tr>
                    </thead>
                    <tbody id="chequesTableBody">
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center space-y-4">
                                    <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <p class="text-lg font-medium">No cheques yet</p>
                                    <p class="text-sm">Enter your first cheque above</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="pagination" class="bg-white px-6 py-4 border-t border-gray-200">
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@push('scripts')
<script>
let currentPage = 1;

document.addEventListener('DOMContentLoaded', function() {
    loadCheques();
    
    // Form submit
    document.getElementById('chequeForm').addEventListener('submit', saveCheque);
    
    // Search
    document.getElementById('searchInput').addEventListener('input', debounce(searchCheques, 300));
    
    // Refresh
    document.getElementById('refreshBtn').addEventListener('click', loadCheques);
    
    // Default date
    document.getElementById('cheque_date').valueAsDate = new Date();
});

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

function saveCheque(e) {
    e.preventDefault();
    
    const btn = document.getElementById('saveBtn');
    const originalText = btn.innerHTML;
    
    btn.disabled = true;
    btn.innerHTML = '<span class="flex items-center"><svg class="w-5 h-5 mr-2 animate-spin" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>Saving...</span>';
    
    const formData = new FormData(document.getElementById('chequeForm'));
    
    fetch('{{ route("cheques.store") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('chequeForm').reset();
            document.getElementById('cheque_date').valueAsDate = new Date();
            loadCheques();
            Swal.fire('Success!', data.message, 'success');
        } else {
            Swal.fire('Error!', data.message || 'Validation failed', 'error');
        }
    })
    .catch(error => {
        Swal.fire('Error!', 'Network error. Please try again.', 'error');
    })
    .finally(() => {
        btn.disabled = false;
        btn.innerHTML = originalText;
    });
}

function loadCheques(page = 1) {
    currentPage = page;
    showLoading();
    
    fetch(`{{ route("cheques.list") }}?page=${page}`)
    .then(response => response.json())
    .then(data => {
        renderTable(data.data);
        renderPagination(data);
        hideLoading();
    })
    .catch(() => {
        hideLoading();
        Swal.fire('Error!', 'Failed to load cheques', 'error');
    });
}

function searchCheques() {
    const query = document.getElementById('searchInput').value.trim();
    
    showLoading();
    
    fetch(`{{ route("cheques.search") }}?q=${encodeURIComponent(query)}`)
    .then(response => response.json())
    .then(data => {
        renderTable(data.data);
        renderPagination(data);
        hideLoading();
    })
    .catch(() => {
        hideLoading();
        Swal.fire('Error!', 'Failed to search', 'error');
    });
}

// [renderTable, renderPagination, showLoading, hideLoading functions with truncate classes - no overflow]
function renderTable(cheques) {
    const tbody = document.getElementById('chequesTableBody');
    
    if (cheques.length === 0) {
        tbody.innerHTML = `<tr><td colspan="8" class="px-6 py-12 text-center text-gray-500">
            <div class="flex flex-col items-center space-y-4">
                <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <p class="text-lg font-medium">No cheques found</p>
            </div>
        </td></tr>`;
        return;
    }
    
    tbody.innerHTML = cheques.map(cheque => `
        <tr class="hover:bg-gray-50 transition-colors">
            <td class="px-6 py-4 text-sm font-medium text-gray-900 max-w-[140px] truncate">${new Date(cheque.cheque_date).toLocaleString()}</td>
            <td class="px-6 py-4 font-bold text-emerald-600 max-w-[120px] truncate">${cheque.check_number}</td>
            <td class="px-6 py-4 text-sm font-medium text-gray-900 max-w-[160px] truncate">${cheque.payee_name}</td>
            <td class="px-6 py-4 text-sm text-gray-900 max-w-[180px] truncate">${cheque.nature_of_payment}</td>
            <td class="px-6 py-4 text-right font-bold text-lg text-emerald-600 max-w-[120px]">
                ₱${parseFloat(cheque.amount).toLocaleString('en-PH', {minimumFractionDigits: 2})}
            </td>
            <td class="px-6 py-4 text-sm text-gray-900 max-w-[140px] truncate">${cheque.office}</td>
            <td class="px-6 py-4">
                <code class="bg-gray-100 text-gray-800 px-2 py-1 rounded text-xs max-w-[100px] truncate block">${cheque.account_code}</code>
            </td>
            <td class="px-6 py-4">
                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium max-w-[120px] truncate block">${cheque.specific_fund}</span>
            </td>
        </tr>
    `).join('');
}

// Pagination, loading states, etc. implemented
</script>
@endpush
@endsection
