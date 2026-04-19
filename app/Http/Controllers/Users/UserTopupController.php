<?php

namespace App\Http\Controllers\Users;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserTopupController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('users.topup', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipe_ps' => 'required|in:PS3,PS4,PS5',
            'durasi_jam' => 'required|numeric|min:1'
        ]);

        $user = Auth::user();
        $tambahMenit = $request->durasi_jam * 60;

        if ($request->tipe_ps == 'PS3') {
            $user->saldo_ps3 += $tambahMenit;
        } elseif ($request->tipe_ps == 'PS4') {
            $user->saldo_ps4 += $tambahMenit;
        } elseif ($request->tipe_ps == 'PS5') {
            $user->saldo_ps5 += $tambahMenit;
        }

        $user->save();

        return back()->with('success', ' Berhasil Top Up ' . $request->durasi_jam . ' Jam untuk ' . $request->tipe_ps . '. Selamat Mabar!');
    }
}
