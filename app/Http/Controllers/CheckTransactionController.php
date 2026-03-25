<?php

namespace App\Http\Controllers;

use App\Models\CheckTransaction;
use Illuminate\Http\Request;

class CheckTransactionController extends Controller
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

        $transaction = CheckTransaction::create(array_merge($validated, [
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

    public function fetch()
    {
        $transactions = CheckTransaction::where('user_id', auth()->id())
            ->orderBy('date', 'desc')
            ->paginate(25);

        return response()->json($transactions);
    }

    public function search(Request $request)
    {
        $query = $request->get('q', '');

        $transactions = CheckTransaction::where('user_id', auth()->id())
            ->where('check_no', 'like', '%' . $query . '%')
            ->orderBy('date', 'desc')
            ->paginate(25);

        return response()->json($transactions);
    }

    public function update(Request $request, CheckTransaction $transaction)
    {
        if ($transaction->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'check_no' => 'required|string|max:100|unique:check_transactions,check_no,' . $transaction->id,
            'nature_of_payment' => 'required|string|max:255',
            'specific_fund' => 'required|in:GENERAL FUND PROPER,TRUST FUND,OTHER',
            'amount' => 'required|numeric|min:0.01',
            'date' => 'required|date',
            'office' => 'required|string|max:255',
            'account_code' => 'required|string|max:100',
            'fund_type' => 'required|in:CURRENT,PRIOR',
            'payee_name' => 'required|string|max:255'
        ]);

        $transaction->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Transaction updated!'
        ]);
    }

    public function destroy(CheckTransaction $transaction)
    {
        if ($transaction->user_id !== auth()->id()) {
            abort(403);
        }

        $transaction->delete();

        return response()->json([
            'success' => true,
            'message' => 'Transaction deleted!'
        ]);
    }
}

