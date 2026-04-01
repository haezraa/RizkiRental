<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Console;
use App\Models\Transaction;
use Carbon\Carbon;
use App\Models\Product;
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

        // 2. Hitung Harga Sewa PS (HARGA NORMAL TANPA DISKON MEMBER LAMA)
        $harga_per_jam = 0;

        if ($console->type == 'PS3') $harga_per_jam = 5000;
        if ($console->type == 'PS4') $harga_per_jam = 7000;
        if ($console->type == 'PS5') $harga_per_jam = 12000;

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
        if ($request->has('qty')) {
            foreach ($request->qty as $product_id => $quantity) {
                if ($quantity > 0) {
                    $product = Product::find($product_id);

                    if ($product && $product->stock >= $quantity) {
                        $subtotal = $product->price * $quantity;
                        $total_bayar += $subtotal;

                        $product->decrement('stock', $quantity);

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

        return back()->with('success', 'Sewa dimulai! Unit sudah berjalan.');
    }

    public function toggleTimer($id)
    {
        $console = Console::find($id);
        $transaction = $console->activeTransaction;

        if (!$transaction) return back();

        if ($transaction->status == 'ongoing') {
            $transaction->update([
                'status' => 'paused',
                'paused_at' => Carbon::now()
            ]);
        } elseif ($transaction->status == 'paused') {
            $waktu_pause = Carbon::parse($transaction->paused_at);
            $sekarang = Carbon::now();
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

        return view('rental', compact('ps3_units', 'ps4_units', 'ps5_units', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_unit' => 'required',
            'tipe_ps'   => 'required'
        ]);

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
        $console = Console::find($request->console_id);

        if (!$console || !$console->activeTransaction) {
            return back()->with('error', 'Unit tidak valid atau tidak ada transaksi aktif!');
        }

        $transaction = $console->activeTransaction;
        $total_tambahan = 0;

        if ($request->has('qty')) {
            foreach ($request->qty as $product_id => $quantity) {
                if ($quantity > 0) {
                    $product = Product::find($product_id);

                    if ($product && $product->stock >= $quantity) {
                        $subtotal = $product->price * $quantity;
                        $total_tambahan += $subtotal;

                        $product->decrement('stock', $quantity);

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

        $transaction->increment('total_price', $total_tambahan);

        return back()->with('success', 'Pesanan berhasil dikirim ke ' . $console->name . '! 🍜');
    }
}
