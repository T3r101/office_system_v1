<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function index()
    {
        $totalDeposits = Deposit::where('user_id', auth()->id())->sum('amount');
        return view('deposits.index', compact('totalDeposits'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'payee_name' => 'required|string|max:255',
            'nature_of_payment' => 'required|string|max:255',
            'cheque_number' => 'nullable|string|max:100',
            'specific_fund' => 'required|string',
            'deposit_date' => 'required|date'
        ]);

        $deposit = Deposit::create(array_merge($validated, [
            'user_id' => auth()->id()
        ]));

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Deposit added successfully!',
                'deposit' => $deposit,
                'total_deposits' => Deposit::where('user_id', auth()->id())->sum('amount')
            ]);
        }

        return redirect()->route('deposits.index')->with('success', 'Deposit recorded successfully!');
    }

    public function fetchDeposits(Request $request)
    {
        $deposits = Deposit::where('user_id', auth()->id())
            ->orderBy('deposit_date', 'desc')
            ->limit(50)
            ->get();

        return response()->json($deposits);
    }
}

