<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RecordController extends Controller
{
    public function index(Request $request)
    {
        $query = Record::where('user_id', auth()->id())
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc');

        // Date range filter
        if ($dateFrom = $request->get('date_from')) {
            $query->whereDate('date', '>=', $dateFrom);
        }

        if ($dateTo = $request->get('date_to')) {
            $query->whereDate('date', '<=', $dateTo);
        }

        $records = $query->paginate(15)->withQueryString();

        return view('records.index', compact('records'));
    }

    public function create()
    {
        return view('records.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date'
        ]);

        Record::create(array_merge($validated, [
            'user_id' => auth()->id()
        ]));

        return redirect()->route('records.index')->with('success', 'Record created successfully!');
    }

    public function edit(Record $record)
    {
        if ($record->user_id !== auth()->id()) {
            abort(403);
        }

        return view('records.edit', compact('record'));
    }

    public function update(Request $request, Record $record)
    {
        // Admin can edit any record
        if (auth()->user()->role !== 'admin' && $record->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'amount' => 'required|numeric|min:0',
            'type' => 'nullable|in:income,expense',
            'date' => 'required|date'
        ]);

        $oldData = $record->getOriginal();
        $record->update($validated);

        // Log update (admin only)
        if (auth()->user()->role === 'admin') {
            \App\Models\SystemLog::create([
                'user_id' => auth()->id(),
                'action' => 'record_updated_admin',
                'description' => 'Updated record ID: ' . $record->id,
                'details' => [
                    'record_id' => $record->id,
                    'changes' => array_diff_assoc($record->getAttributes(), $oldData)
                ]
            ]);
        }

        $route = auth()->user()->role === 'admin' ? 'admin.records.index' : 'records.index';
        return redirect()->route($route)->with('success', 'Record updated successfully!');
    }

    public function destroy(Record $record)
    {
        if ($record->user_id !== auth()->id()) {
            abort(403);
        }

        $record->delete();

        return redirect()->route('records.index')->with('success', 'Record deleted successfully!');
    }
}

