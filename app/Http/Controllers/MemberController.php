<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::latest()->get();
        return view('members.index', compact('members'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username_billing' => 'required|unique:members,username_billing|alpha_dash',
            'saldo_menit' => 'required|numeric|min:0',
            'console_type' => 'required',
            'phone' => 'nullable'
        ]);

        Member::create($request->all());
        return back()->with('success', 'Akun Billing berhasil didaftarkan!');
    }

    public function destroy($id)
    {
        Member::find($id)->delete();
        return back()->with('success', 'Akun Billing dihapus!');
    }
}
