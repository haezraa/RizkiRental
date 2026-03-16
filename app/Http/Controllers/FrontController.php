<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Console;
use App\Models\Member;
use App\Models\Transaction;

class FrontController extends Controller
{
    public function index()
    {
        $consoles = Console::all();
        return view('front', compact('consoles'));
    }

    public function bookingTv(Request $request)
    {
        $request->validate([
            'console_id' => 'required',
            'username_billing' => 'required',
            'durasi_jam' => 'required|numeric'
        ]);

        $member = Member::where('username_billing', $request->username_billing)->first();
        $console = Console::find($request->console_id);

        if(!$member) {
            return back()->with('error', '❌ Gagal: Username Billing tidak ditemukan! Silakan daftar di kasir.');
        }

        $memberClass = str_replace(' ', '', strtoupper($member->console_type));
        $consoleClass = str_replace(' ', '', strtoupper($console->type));
        if ($memberClass != $consoleClass) {
            return back()->with('error', "❌ Class tidak sesuai! Akun {$member->name} adalah member {$member->console_type}, tidak bisa booking unit {$console->type}.");
        }

        $butuhMenit = $request->durasi_jam * 60;
        if($member->saldo_menit < $butuhMenit) {
            $sisaJam = floor($member->saldo_menit / 60);
            $sisaMenit = $member->saldo_menit % 60;
            return back()->with('error', "❌ Gagal: Saldo waktu tidak cukup! Sisa saldo kamu cuma {$sisaJam} Jam {$sisaMenit} Menit.");
        }

        if($console->status != 'ready') {
            return back()->with('error', '❌ Yah telat, TV-nya baru aja dibooking orang lain.');
        }

        $member->saldo_menit -= $butuhMenit;
        $member->save();

        $console->status = 'main';
        $console->save();

        Transaction::create([
            'console_id' => $console->id,
            'customer_name' => $member->name . ' (' . $member->username_billing . ')',
            'start_time' => now(),
            'end_time' => now()->addMinutes($butuhMenit),
            'duration_minutes' => $butuhMenit,
            'total_price' => 0,
            'status' => 'ongoing'
        ]);

        return back()->with('success', '✅ Booking Berhasil! Sisa saldo: ' . ($member->saldo_menit/60) . ' Jam. Silakan menuju ' . $console->name);
    }
}
