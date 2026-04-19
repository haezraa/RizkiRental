@extends('parts.layout')

@section('judul_halaman', 'Stok Gudang')

@section('header_actions')
    <button onclick="document.getElementById('addMenuModal').classList.remove('hidden')"
        class="bg-[#2251a5] hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-bold flex items-center gap-2 transition shadow-md hover:-translate-y-0.5 transform">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
        Tambah Menu
    </button>
@endsection

@section('konten')

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 font-bold text-xs text-gray-500 uppercase">Nama Produk</th>
                    <th class="px-6 py-4 font-bold text-xs text-gray-500 uppercase">Kategori</th>
                    <th class="px-6 py-4 font-bold text-xs text-gray-500 uppercase">Harga</th>
                    <th class="px-6 py-4 font-bold text-xs text-gray-500 uppercase text-center">Stok</th>
                    <th class="px-6 py-4 font-bold text-xs text-gray-500 uppercase text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($products as $item)
                    <tr class="hover:bg-blue-50/50 transition">
                        <td class="px-6 py-4 font-bold text-gray-800">{{ $item->name }}</td>
                        <td class="px-6 py-4">
                            @if ($item->category == 'makanan')
                                <span class="bg-orange-100 text-orange-600 px-2 py-1 rounded text-xs font-bold">🍜 Makanan</span>
                            @else
                                <span class="bg-blue-100 text-blue-600 px-2 py-1 rounded text-xs font-bold">🥤 Minuman</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-mono text-gray-600">Rp {{ number_format($item->price, 0, ',', '.') }}</td>

                        <td class="px-6 py-4 text-center">
                            <form action="{{ route('fnb.quick_stock', $item->id) }}" method="POST" class="flex items-center justify-center gap-2">
                                @csrf
                                @method('PATCH')

                                <input type="number" name="stock" value="{{ $item->stock }}"
                                    class="w-16 text-center border border-gray-300 rounded p-1 text-sm font-bold focus:ring-2 focus:ring-blue-500 focus:outline-none {{ $item->stock <= 5 ? 'text-red-500 bg-red-50' : 'text-gray-700' }}">

                                <button type="submit" class="text-blue-600 hover:text-blue-800 text-xs font-bold">💾</button>
                            </form>
                        </td>

                        <td class="px-6 py-4 text-right flex justify-end gap-2">
                            <button onclick="openEditModal('{{ $item->id }}', '{{ $item->name }}', '{{ $item->category }}', '{{ $item->price }}', '{{ $item->stock }}')"
                                class="text-blue-500 hover:text-blue-700 transition">
                                <svg class="w-5 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <form id="deleteFoodForm-{{ $item->id }}" action="{{ route('fnb.destroy', $item->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="button" onclick="openConfirm('Hapus menu {{ $item->name }}? Stok akan hilang.', 'deleteFoodForm-{{ $item->id }}')"
                                    class="text-gray-400 hover:text-red-600 transition">
                                    <svg class="w-5 h-5 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-400 italic">Belum ada menu makanan/minuman.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div id="addMenuModal" class="fixed inset-0 bg-black/60 hidden flex items-center justify-center z-50 backdrop-blur-sm p-4">
        <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl overflow-hidden border border-gray-200">
            <div class="bg-[#2251a5] px-6 py-4 flex justify-between items-center">
                <h3 class="text-lg font-bold text-white">Tambah Menu Baru</h3>
                <button onclick="document.getElementById('addMenuModal').classList.add('hidden')" class="text-white/70 hover:text-white text-2xl leading-none">&times;</button>
            </div>

            <form action="{{ route('fnb.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf

                <div class="mb-4">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nama Menu</label>
                    <input type="text" name="name" class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500" required placeholder="Contoh: Indomie Goreng">
                </div>

                <div class="mb-4">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Kategori</label>
                    <select name="category" class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500">
                        <option value="makanan">🍜 Makanan</option>
                        <option value="minuman">🥤 Minuman</option>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Harga (Rp)</label>
                        <input type="number" name="price" class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500" required placeholder="5000">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Stok Awal</label>
                        <input type="number" name="stock" class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500" required placeholder="10">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Foto Menu (Opsional)</label>
                    <input type="file" name="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-l-lg file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="mt-1 text-[10px] text-gray-400">Format: JPG, PNG. Maks 2MB.</p>
                </div>

                <button type="submit" class="w-full bg-[#2251a5] text-white py-3 rounded-xl font-bold hover:bg-blue-800 transition shadow-lg">
                    SIMPAN DATA
                </button>
            </form>
        </div>
    </div>

    <div id="editProductModal" class="fixed inset-0 bg-black/60 hidden flex items-center justify-center z-50 backdrop-blur-sm p-4">
        <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl overflow-hidden border border-gray-200">

            <div class="bg-[#2251a5] px-6 py-4 flex justify-between items-center">
                <h3 class="text-lg font-bold text-white flex items-center gap-2">
                    <span></span> <span>Edit Menu</span>
                </h3>
                <button onclick="closeEditModal()" class="text-white/70 hover:text-white text-2xl leading-none">&times;</button>
            </div>

            <form id="editForm" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                <div class="mb-4">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nama Menu</label>
                    <input type="text" name="name" id="editName" class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div class="mb-4">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Kategori</label>
                    <select name="category" id="editCategory" class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500">
                        <option value="makanan">🍜 Makanan</option>
                        <option value="minuman">🥤 Minuman</option>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Harga</label>
                        <input type="number" name="price" id="editPrice" class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Stok</label>
                        <input type="number" name="stock" id="editStock" class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500" required>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Ganti Foto (Opsional)</label>
                    <input type="file" name="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-l-lg file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <button type="submit" class="w-full bg-[#2251a5] text-white py-3 rounded-xl font-bold hover:bg-blue-800 transition shadow-lg">
                    UPDATE DATA
                </button>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(id, name, category, price, stock) {
            document.getElementById('editName').value = name;
            document.getElementById('editCategory').value = category;
            document.getElementById('editPrice').value = price;
            document.getElementById('editStock').value = stock;

            document.getElementById('editForm').action = "/fnb/update/" + id;

            document.getElementById('editProductModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editProductModal').classList.add('hidden');
        }
    </script>
@endsection
