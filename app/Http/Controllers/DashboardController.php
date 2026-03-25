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
        $recentRecords = Record::where('user_id', $userId)
            ->latest('created_at')
            ->limit(5)
            ->get();

        // Monthly chart data
        $monthlyChart = Record::where('user_id', $userId)
            ->whereYear('date', Carbon::now()->year)
            ->selectRaw('MONTH(date) as month, SUM(amount) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $chartLabels = [];
        $chartDataValues = [];
        for ($m = 1; $m <= 12; $m++) {
            $chartLabels[] = $months[$m-1];
            $chartDataValues[] = $monthlyChart[$m] ?? 0;
        }

        // Records chart data
        $recordsChartData = [
            'labels' => ['Total Records'],
            'datasets' => [[
                'data' => [$totalRecords],
                'backgroundColor' => ['#3B82F6']
            ]]
        ];

        return view('dashboard', compact(
            'totalRecords',
            'totalAmount',
            'thisMonthTotal',
            'totalUploads',
            'totalDeposits',
            'incomeTotal',
            'expenseTotal',
            'recentRecords',
            'chartLabels',
            'chartDataValues',
            'recordsChartData'
        ));
    }
}

