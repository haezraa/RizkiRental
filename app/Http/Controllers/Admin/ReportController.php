<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->start_date ? Carbon::parse($request->start_date) : Carbon::today();
        $endDate = $request->end_date ? Carbon::parse($request->end_date) : Carbon::today();

        $transactions = Transaction::with(['console', 'details.product'])
                                   ->whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()])
                                   ->where('status', 'finished')
                                   ->latest()
                                   ->get();

        $total_income = $transactions->sum('total_price');
        $total_transaksi = $transactions->count();

        return view('admin.reports', compact('transactions', 'total_income', 'total_transaksi', 'startDate', 'endDate'));
    }
}
