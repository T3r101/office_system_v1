<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});



Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');




Route::middleware('auth')->group(function () {
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->only(['index', 'edit', 'update']);
        Route::post('users/{user}/toggle-status', [\App\Http\Controllers\Admin\UserController::class, 'toggleStatus'])->name('users.toggle-status');
    });


    Route::middleware(['role:admin'])->prefix('accounts')->name('accounts.')->group(function () {
        Route::get('/', [\App\Http\Controllers\AccountController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\AccountController::class, 'create'])->name('create');
        Route::post('/', [\App\Http\Controllers\AccountController::class, 'store'])->name('store');
        Route::post('/{user}/toggle', [\App\Http\Controllers\AccountController::class, 'toggleActive'])->name('toggle');
        Route::delete('/{user}', [\App\Http\Controllers\AccountController::class, 'destroy'])->name('destroy');
    });
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard Routes

    Route::get('/import', [ImportController::class, 'index'])->name('import.excel');
    Route::post('/import/preview', [ImportController::class, 'preview'])->name('import.preview');
    Route::post('/import', [ImportController::class, 'store'])->name('import.store');

// User records (limited)
Route::middleware('role:admin')->resource('admin.records', RecordController::class)->only(['edit', 'update']);
Route::resource('records', RecordController::class)->only(['index', 'create', 'store', 'destroy']);

Route::middleware('auth')->group(function () {
    Route::get('/cheques', [ChequeController::class, 'index'])->name('cheques.index');
    Route::post('/cheques', [ChequeController::class, 'store'])->name('cheques.store');
    Route::get('/cheques/list', [ChequeController::class, 'fetchCheques'])->name('cheques.list');
    Route::get('/cheques/search', [ChequeController::class, 'search'])->name('cheques.search');
});

// New features
Route::get('/transactions', [\App\Http\Controllers\TransactionController::class, 'index'])->name('transactions.index');
Route::post('/transactions/store', [\App\Http\Controllers\TransactionController::class, 'store'])->name('transactions.store');
Route::get('/transactions/list', [\App\Http\Controllers\TransactionController::class, 'fetchTransactions'])->name('transactions.fetch');
Route::get('/deposits', [\App\Http\Controllers\DepositController::class, 'index'])->name('deposits.index');
Route::post('/deposits/store', [\App\Http\Controllers\DepositController::class, 'store'])->name('deposits.store');
Route::get('/deposits/list', [\App\Http\Controllers\DepositController::class, 'fetchDeposits'])->name('deposits.fetch');



});


require __DIR__.'/auth.php';
