<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Console;
use App\Models\Transaction;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Member;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function startSession(Request $request)
    {
        // 1. Validasi & Cari Console
        $console = Console::find($request->console_id);
        if (!$console || $console->status == 'active') {
            return back()->with('error', 'Unit error!');
        }

        // 2. Hitung Harga Sewa PS (UPDATE HARGA DISINI JUGA)
        $harga_per_jam = 0;

        // --- HARGA BARU ---
        if ($console->type == 'PS3') $harga_per_jam = 5000;
        if ($console->type == 'PS4') $harga_per_jam = 7000;
        if ($console->type == 'PS5') $harga_per_jam = 12000;

        // Cek apakah user milih member di form?
        if ($request->has('member_id') && !empty($request->member_id)) {
            // HARGA MEMBER (Diskon)
            if($console->type == 'PS3') $harga_per_jam = 4000;  // Hemat 1rb
            if($console->type == 'PS4') $harga_per_jam = 6000;  // Hemat 1rb
            if($console->type == 'PS5') $harga_per_jam = 10000; // Hemat 2rb
        }

        $durasi_jam = (int) $request->durasi;
        $biaya_sewa = $harga_per_jam * $durasi_jam;
        $total_bayar = $biaya_sewa;

        // 3. Simpan Transaksi Utama
        $transaction = Transaction::create([
            'console_id' => $console->id,
            'customer_name' => $request->nama_pemain,
            'duration_minutes' => $durasi_jam * 60,
            'start_time' => Carbon::now(),
            'end_time' => Carbon::now()->addHours($durasi_jam),
            'total_price' => 0,
            'status' => 'ongoing'
        ]);

        // 4. LOGIC FnB (MAKANAN)
        // Cek apakah ada input dari form?
        if ($request->has('qty')) {
            foreach ($request->qty as $product_id => $quantity) {
                // Kalau quantity diisi lebih dari 0 (artinya dia pesen)
                if ($quantity > 0) {
                    $product = Product::find($product_id);

                    // Cek stok cukup ga
                    if ($product && $product->stock >= $quantity) {
                        $subtotal = $product->price * $quantity;
                        $total_bayar += $subtotal;

                        // Kurangi Stok
                        $product->decrement('stock', $quantity);

                        // Simpan ke Tabel Detail
                        DB::table('transaction_details')->insert([
                            'transaction_id' => $transaction->id,
                            'product_id' => $product->id,
                            'quantity' => $quantity,
                            'price' => $product->price,
                            'subtotal' => $subtotal,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        }

        // 5. Update Total Harga Transaksi & Status Console
        $transaction->update(['total_price' => $total_bayar]);
        $console->update(['status' => 'main']);

        return back()->with('success', 'Sewa dimulai! Stok makanan sudah berkurang otomatis.');
    }

    // FUNGSI BUAT PAUSE & RESUME TIMER
    public function toggleTimer($id)
    {
        $console = Console::find($id);
        $transaction = $console->activeTransaction;

        if (!$transaction) return back();

        if ($transaction->status == 'ongoing') {
            //LOGIC PAUSE
            $transaction->update([
                'status' => 'paused',
                'paused_at' => Carbon::now()
            ]);
        } elseif ($transaction->status == 'paused') {
            //LOGIC RESUME
            $waktu_pause = Carbon::parse($transaction->paused_at);
            $sekarang = Carbon::now();

            //Selisih waktu
            $selisih_menit = $waktu_pause->diffInMinutes($sekarang);

            $new_end_time = Carbon::parse($transaction->end_time)->addMinutes($selisih_menit);

            $transaction->update([
                'status' => 'ongoing',
                'end_time' => $new_end_time,
                'paused_at' => null
            ]);
        }

        return back();
    }

    // FUNGSI RESET / STOP
    public function stopSession($id)
    {
        $console = Console::find($id);
        $transaction = $console->activeTransaction;

        if ($transaction) {
            $transaction->update(['status' => 'finished']);
        }

        $console->update(['status' => 'ready']);

        return back()->with('success', 'Sesi selesai. Unit ready kembali.');
    }

    public function index()
    {
        //LOGIC AUTO RESET
        $expired_transactions = Transaction::where('status', 'ongoing')
            ->where('end_time', '<=', Carbon::now())
            ->get();

        foreach ($expired_transactions as $trans) {
            $trans->update(['status' => 'finished']);

            if ($trans->console) {
                $trans->console->update(['status' => 'ready']);
            }
        }

        // Query data
        $ps3_units = Console::where('type', 'PS3')->get();
        $ps4_units = Console::where('type', 'PS4')->get();
        $ps5_units = Console::where('type', 'PS5')->get();

        // Ambil produk buat modal
        $products = Product::where('stock', '>', 0)->get();

        $members = Member::orderBy('name')->get();

        return view('rental', compact('ps3_units', 'ps4_units', 'ps5_units', 'products', 'members'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_unit' => 'required',
            'tipe_ps'   => 'required'
        ]);

        // Simpan data baru
        Console::create([
            'name'   => $request->nama_unit,
            'type'   => $request->tipe_ps,
            'status' => 'ready',
            'price_per_hour' => 0
        ]);

        return redirect()->route('rental')->with('success', 'Unit baru berhasil dibuat!');
    }

    public function destroy($id)
    {
        $console = Console::find($id);

        if ($console) {
            $console->delete();
            return redirect()->route('rental')->with('success', 'Unit berhasil dihapus.');
        }

        return redirect()->route('rental')->with('error', 'Unit tidak ditemukan.');
    }

    public function addOrder(Request $request)
    {
        // 1. Cari Unit & Transaksi yang lagi jalan
        $console = Console::find($request->console_id);

        // Pastikan unit ada dan punya transaksi
        if (!$console || !$console->activeTransaction) {
            return back()->with('error', 'Unit tidak valid atau tidak ada transaksi aktif!');
        }

        $transaction = $console->activeTransaction;
        $total_tambahan = 0;

        // 2. Loop pesanan dari Cart
        if ($request->has('qty')) {
            foreach ($request->qty as $product_id => $quantity) {
                if ($quantity > 0) {
                    $product = Product::find($product_id);

                    // Cek stok
                    if ($product && $product->stock >= $quantity) {
                        $subtotal = $product->price * $quantity;
                        $total_tambahan += $subtotal;

                        // Kurangi Stok
                        $product->decrement('stock', $quantity);

                        // Catat di Rincian
                        DB::table('transaction_details')->insert([
                            'transaction_id' => $transaction->id,
                            'product_id' => $product->id,
                            'quantity' => $quantity,
                            'price' => $product->price,
                            'subtotal' => $subtotal,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        }

        // 3. Update Total Harga di Transaksi Utama
        $transaction->increment('total_price', $total_tambahan);

        return back()->with('success', 'Pesanan berhasil dikirim ke ' . $console->name . '! 🍜');
    }
}
