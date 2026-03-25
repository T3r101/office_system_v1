<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        return view('transactions.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'check_no' => 'required|string|max:100|unique:check_transactions,check_no',
            'nature_of_payment' => 'required|string|max:255',
            'specific_fund' => 'required|in:GENERAL FUND PROPER,TRUST FUND,OTHER',
            'amount' => 'required|numeric|min:0.01',
            'date' => 'required|date',
            'office' => 'required|string|max:255',
            'account_code' => 'required|string|max:100',
            'fund_type' => 'required|in:CURRENT,PRIOR',
            'payee_name' => 'required|string|max:255'
        ]);

        $transaction = \App\Models\CheckTransaction::create(array_merge($validated, [
            'user_id' => auth()->id()
        ]));

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Check transaction saved!',
                'transaction' => $transaction
            ]);
        }

        return redirect()->route('transactions.index')->with('success', 'Transaction saved!');
    }

public function fetch(Request $request)
    {
        $query = \App\Models\CheckTransaction::where('user_id', auth()->id())
            ->orderBy('date', 'desc')
            ->limit(50);

        if ($request->q) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        $transactions = $query->get();

        return response()->json($transactions);
    }
}

