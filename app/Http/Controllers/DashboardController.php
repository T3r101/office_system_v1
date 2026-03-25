<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\Upload;
use App\Models\Deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // Single query for all Record stats
        $recordStats = Record::where('user_id', $userId)
            ->selectRaw('
                COUNT(*) as total_records,
                SUM(amount) as total_amount,
                SUM(CASE WHEN MONTH(date) = ? AND YEAR(date) = ? THEN amount ELSE 0 END) as this_month_total
            ', [Carbon::now()->month, Carbon::now()->year])
            ->first();

        $totalRecords = $recordStats->total_records ?? 0;
        $totalAmount = $recordStats->total_amount ?? 0;
        $thisMonthTotal = $recordStats->this_month_total ?? 0;

        $totalUploads = Upload::where('user_id', $userId)->count('id');

        // Deposits total
        $totalDeposits = Deposit::where('user_id', $userId)->sum('amount');

        // Income/Expense split
        $incomeTotal = Record::where('user_id', $userId)
            ->where('type', 'income')
            ->sum('amount');
        $expenseTotal = Record::where('user_id', $userId)
            ->where('type', 'expense')
            ->sum('amount');

        // Recent records






        // Monthly Activity (current year, user-scoped)
        $monthlyActivity = DB::table('records')
            ->where('user_id', $userId)
            ->whereYear('created_at', Carbon::now()->year)
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as total_transactions, SUM(amount) as total_amount')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Top Users (by total records count, all users)
        $topUsers = DB::table('records')
            ->join('users', 'records.user_id', '=', 'users.id')
            ->selectRaw('users.name, COUNT(records.id) as total_transactions, SUM(records.amount) as total_amount')
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('total_transactions')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalRecords',
            'totalAmount',
            'thisMonthTotal',
            'totalUploads',
            'totalDeposits',
            'incomeTotal',
            'expenseTotal',
            'monthlyActivity',
            'topUsers'
        )); 
    }
}

