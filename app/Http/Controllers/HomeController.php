<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Console;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $pemasukan_hari_ini = Transaction::whereDate('created_at', Carbon::today())
                                ->sum('total_price');

        $unit_sedang_main = Console::where('status', 'main')->count();

        $total_transaksi = Transaction::whereDate('created_at', Carbon::today())->count();

        $riwayat_terbaru = Transaction::with('console')
                            ->latest()
                            ->take(5)
                            ->get();

        return view('home', compact(
            'pemasukan_hari_ini',
            'unit_sedang_main',
            'total_transaksi',
            'riwayat_terbaru'
        ));
    }
}
