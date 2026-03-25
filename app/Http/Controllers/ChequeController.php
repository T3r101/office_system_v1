<?php

namespace App\Http\Controllers;

use App\Models\Cheque;
use Illuminate\Http\Request;

class ChequeController extends Controller
{
    public function index()
    {
        return view('cheques.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'check_number' => 'required|string|max:100|unique:cheques,check_number',
            'nature_of_payment' => 'required|string|max:255',
            'specific_fund' => 'required|string|max:100',
            'office' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'cheque_date' => 'required|date',
            'payee_name' => 'required|string|max:255',
            'account_code' => 'required|string|max:100',
            'type' => 'required|in:current,prior,continuing',
        ]);

        $cheque = Cheque::create(array_merge($validated, [
            'user_id' => auth()->id()
        ]));

        return response()->json([
            'success' => true,
            'message' => 'Cheque saved successfully!',
            'cheque' => $cheque
        ]);
    }

    public function fetchCheques()
    {
        $cheques = Cheque::where('user_id', auth()->id())
            ->latest('cheque_date')
            ->paginate(25);

        return response()->json($cheques);
    }

    public function search(Request $request)
    {
        $query = $request->get('q', '');

        $cheques = Cheque::where('user_id', auth()->id())
            ->where('check_number', 'like', '%' . $query . '%')
            ->latest('cheque_date')
            ->paginate(25);

        return response()->json($cheques);
    }
}

