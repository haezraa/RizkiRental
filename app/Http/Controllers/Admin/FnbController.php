<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Console;
use Illuminate\Support\Facades\Storage;

class FnbController extends Controller
{
    // Halaman Utama
    public function index()
    {
        $products = Product::all();
        return view('admin.fnbstok', compact('products'));
    }

    // Simpan Menu Baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'category' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = $path;
        }

        Product::create($data);

        return back()->with('success', 'Menu berhasil ditambah!');
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $request->validate([
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            if (!$file->isValid()) {
                dd("File Corrupt/Kegedean. Cek php.ini upload_max_filesize");
            }

            if ($product->image && file_exists(storage_path('app/public/' . $product->image))) {
                unlink(storage_path('app/public/' . $product->image));
            }

            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(storage_path('app/public/products'), $filename);

            $data['image'] = 'products/' . $filename;
        }

        $product->update($data);

        return back()->with('success', 'Menu berhasil diupdate!');
    }

    // Hapus Menu
    public function destroy($id)
    {
        Product::find($id)->delete();
        return back()->with('success', 'Menu dihapus.');
    }

    // Update Stok
    public function updateStock(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update(['stock' => $request->stock]);
        return back();
    }

    public function cashier()
    {
        $products = Product::where('stock', '>', 0)->get();

        $active_consoles = Console::whereIn('status', ['main', 'paused'])->get();

        return view('admin.fnborder', compact('products', 'active_consoles'));
    }
}
