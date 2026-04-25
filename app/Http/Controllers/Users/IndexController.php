<?php

namespace App\Http\Controllers\Users;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Console;
use App\Models\Transaction;
use Carbon\Carbon;

class IndexController extends Controller
{
    public function index()
    {
        $expired_transactions = Transaction::whereIn('status', ['ongoing', 'paused'])
            ->where('end_time', '<=', Carbon::now('Asia/Jakarta'))
            ->get();

        foreach ($expired_transactions as $trans) {
            $trans->update(['status' => 'finished']);
            if ($trans->console) {
                $trans->console->update(['status' => 'ready']);
            }
        }

        $stuck_consoles = Console::where('status', 'main')->get();
        foreach ($stuck_consoles as $console) {
            $activeTrans = Transaction::where('console_id', $console->id)
                            ->whereIn('status', ['ongoing', 'paused'])
                            ->first();

            if (!$activeTrans) {
                $console->update(['status' => 'ready']);
            }
        }

        $consoles = Console::all();
        return view('users.index', compact('consoles'));
    }

    public function bookingTv(Request $request)
    {
        if (!auth()->check()) {
            return back()->with('error', '❌ Gagal: Kamu harus login dulu buat booking!');
        }

        $user = auth()->user();

        $sedangMain = Transaction::where('customer_name', $user->name)
            ->whereIn('status', ['ongoing', 'paused'])
            ->first();

        if ($sedangMain) {
            return back()->with('error', '❌ Gagal: Kamu masih punya booking TV yang sedang jalan! Tunggu sampai habis ya.');
        }

        $request->validate([
            'console_id' => 'required',
            'durasi_jam' => 'required|numeric|min:1'
        ]);

        $console = Console::find($request->console_id);
        $butuhMenit = $request->durasi_jam * 60;

        $consoleType = strtoupper(str_replace(' ', '', $console->type));

        if ($consoleType == 'PS3') {
            if ($user->saldo_ps3 < $butuhMenit) return back()->with('error', "❌ Saldo PS3 kamu gak cukup!");
            $user->saldo_ps3 -= $butuhMenit;
        } elseif ($consoleType == 'PS4') {
            if ($user->saldo_ps4 < $butuhMenit) return back()->with('error', "❌ Saldo PS4 kamu gak cukup!");
            $user->saldo_ps4 -= $butuhMenit;
        } elseif ($consoleType == 'PS5') {
            if ($user->saldo_ps5 < $butuhMenit) return back()->with('error', "❌ Saldo PS5 kamu gak cukup!");
            $user->saldo_ps5 -= $butuhMenit;
        } else {
            return back()->with('error', "❌ Tipe konsol tidak dikenali.");
        }

        if($console->status != 'ready') {
            return back()->with('error', '❌ Yah telat, TV-nya baru aja dibooking orang lain.');
        }

        $user->save();
        $console->status = 'main';
        $console->save();

        Transaction::create([
            'console_id' => $console->id,
            'customer_name' => $user->name,
            'start_time' => Carbon::now('Asia/Jakarta'),
            'end_time' => Carbon::now('Asia/Jakarta')->addMinutes($butuhMenit),
            'duration_minutes' => $butuhMenit,
            'total_price' => 0,
            'status' => 'ongoing'
        ]);

        return back()->with('success', '✅ Booking Berhasil! Silakan menuju ' . $console->name . ' 🎮');
    }
}
