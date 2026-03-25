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

        // Monthly chart data
        $monthlyChartData = [
            'labels' => $chartLabels,
            'datasets' => [[
                'label' => 'Amount',
                'data' => $chartDataValues,
                'borderColor' => 'rgb(99 102 241)',
                'backgroundColor' => 'rgba(99 102 241, 0.1)',
                'borderWidth' => 3,
                'fill' => true,
                'tension' => 0.4,
                'pointBackgroundColor' => 'rgb(99 102 241)',
                'pointBorderColor' => '#fff',
                'pointHoverBackgroundColor' => '#fff',
                'pointHoverBorderColor' => 'rgb(99 102 241)',
                'pointRadius' => 6,
                'pointHoverRadius' => 8
            ]]
        ];

        // Category chart data
        $categoryData = Record::where('user_id', $userId)
            ->whereYear('date', Carbon::now()->year)
            ->selectRaw('category, SUM(amount) as total')
            ->groupBy('category')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->pluck('total', 'category')
            ->toArray();

        $categoryChartData = [
            'labels' => array_keys($categoryData),
            'datasets' => [[
                'data' => array_values($categoryData),
                'backgroundColor' => [
                    'rgb(99 102 241)',
                    'rgb(16 185 129)',
                    'rgb(245 158 11)',
                    'rgb(239 68 68)',
                    'rgb(168 85 247)'
                ],
                'borderWidth' => 0,
                'hoverOffset' => 4
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
            'monthlyChartData',
            'categoryChartData'
        )); 
    }
}

