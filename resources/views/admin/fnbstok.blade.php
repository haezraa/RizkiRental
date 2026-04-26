@extends('parts.layout')

@section('judul_halaman', 'Stok Gudang')

@section('header_actions')
    <button onclick="document.getElementById('addMenuModal').classList.remove('hidden')"
        class="bg-brand-blue hover:bg-blue-800 text-white px-5 py-2.5 rounded-xl font-bold flex items-center gap-2 transition-all shadow-md shadow-blue-900/20 hover:shadow-lg hover:-translate-y-0.5 text-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
        Tambah Menu
    </button>
@endsection

@section('konten')

    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50/80 backdrop-blur-sm border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-5 font-extrabold text-xs text-slate-400 uppercase tracking-wider">Nama Produk</th>
                        <th class="px-6 py-5 font-extrabold text-xs text-slate-400 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-5 font-extrabold text-xs text-slate-400 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-5 font-extrabold text-xs text-slate-400 uppercase tracking-wider text-center">Stok</th>
                        <th class="px-6 py-5 font-extrabold text-xs text-slate-400 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($products as $item)
                        <tr class="hover:bg-blue-50/30 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-extrabold text-slate-800 tracking-tight">{{ $item->name }}</div>
                            </td>
                            <td class="px-6 py-4">
                                @if ($item->category == 'makanan')
                                    <span class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-600 border border-amber-200/60 px-3 py-1 rounded-lg text-xs font-bold shadow-sm">
                                        <span>🍜</span> Makanan
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 bg-sky-50 text-sky-600 border border-sky-200/60 px-3 py-1 rounded-lg text-xs font-bold shadow-sm">
                                        <span>🥤</span> Minuman
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-black text-brand-blue">
                                Rp {{ number_format($item->price, 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-4">
                                <form action="{{ route('fnb.quick_stock', $item->id) }}" method="POST" class="flex items-center justify-center gap-2">
                                    @csrf
                                    @method('PATCH')

                                    <div class="relative">
                                        <input type="number" name="stock" value="{{ $item->stock }}"
                                            class="w-20 text-center border {{ $item->stock <= 5 ? 'border-rose-300 bg-rose-50 text-rose-600 ring-rose-100' : 'border-slate-200 bg-slate-50 text-slate-700' }} rounded-xl p-2 text-sm font-extrabold focus:ring-2 focus:ring-brand-blue focus:border-brand-blue focus:outline-none transition-all shadow-sm">

                                        @if($item->stock <= 5)
                                            <div class="absolute -top-1 -right-1 w-3 h-3 bg-rose-500 border-2 border-white rounded-full animate-pulse"></div>
                                        @endif
                                    </div>

                                    <button type="submit" class="w-9 h-9 bg-slate-100 text-brand-blue hover:bg-brand-blue hover:text-white rounded-xl flex items-center justify-center transition-colors shadow-sm" title="Simpan Stok">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                    </button>
                                </form>
                            </td>

                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <button onclick="openEditModal('{{ $item->id }}', '{{ $item->name }}', '{{ $item->category }}', '{{ $item->price }}', '{{ $item->stock }}')"
                                        class="w-9 h-9 bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white rounded-lg flex items-center justify-center transition-all" title="Edit Menu">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>

                                    <form id="deleteFoodForm-{{ $item->id }}" action="{{ route('fnb.destroy', $item->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="button" onclick="openConfirm('Hapus menu {{ $item->name }}? Stok akan hilang permanen.', 'deleteFoodForm-{{ $item->id }}')"
                                            class="w-9 h-9 bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white rounded-lg flex items-center justify-center transition-all" title="Hapus Menu">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-slate-400">
                                    <svg class="w-12 h-12 mb-3 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                    <p class="font-bold text-sm">Belum ada menu makanan/minuman.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div id="addMenuModal" class="fixed inset-0 bg-slate-900/60 hidden flex items-center justify-center z-50 backdrop-blur-sm p-4 transition-opacity duration-300">
        <div class="bg-white w-full max-w-md rounded-[2rem] shadow-2xl overflow-hidden border border-slate-200 transform transition-all">

            <div class="bg-gradient-to-r from-[#1e448e] to-[#153166] px-6 py-5 flex justify-between items-center relative overflow-hidden">
                <div class="absolute right-0 top-0 w-24 h-24 bg-white/5 rounded-full blur-xl -mr-10 -mt-10"></div>
                <h3 class="text-lg font-extrabold text-white flex items-center gap-2 relative z-10">
                    <span>📦</span> <span>Tambah Menu Baru</span>
                </h3>
                <button type="button" onclick="document.getElementById('addMenuModal').classList.add('hidden')" class="text-white/50 hover:text-white text-2xl leading-none relative z-10">&times;</button>
            </div>

            <form action="{{ route('fnb.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf

                <div class="mb-5">
                    <label class="block text-xs font-extrabold text-slate-500 uppercase mb-2 tracking-wider">Nama Menu</label>
                    <input type="text" name="name" class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 font-bold text-slate-800 focus:ring-2 focus:ring-brand-blue focus:border-brand-blue focus:outline-none transition-all shadow-sm" required placeholder="Contoh: Indomie Goreng">
                </div>

                <div class="mb-5 relative" id="addCategoryDropdownWrapper">
                    <label class="block text-xs font-extrabold text-slate-500 uppercase mb-2 tracking-wider">Kategori</label>
                    <input type="hidden" name="category" id="addCategoryInput" value="makanan">

                    <button type="button" onclick="toggleAddCategoryDropdown()" id="addCategoryBtn"
                        class="w-full flex items-center justify-between bg-slate-50 border border-slate-200 rounded-xl p-3 font-bold text-brand-blue focus:ring-2 focus:ring-brand-blue focus:border-brand-blue outline-none transition-all shadow-sm">
                        <span id="addCategoryText" class="flex items-center gap-2"><span>🍜</span> Makanan</span>
                        <svg class="w-5 h-5 text-slate-400 transition-transform duration-200 flex-shrink-0" id="addCategoryIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>

                    <div id="addCategoryMenu" class="absolute left-0 right-0 top-[85px] bg-white rounded-xl shadow-[0_10px_25px_-5px_rgba(0,0,0,0.1)] border border-slate-100 opacity-0 invisible scale-95 origin-top transition-all duration-200 z-50">
                        <div class="p-1.5 flex flex-col gap-0.5">
                            <button type="button" onclick="selectAddCategory('makanan', '🍜 Makanan')" class="w-full text-left px-3 py-2.5 text-sm font-bold text-slate-700 hover:bg-blue-50 hover:text-brand-blue rounded-lg transition-colors flex items-center gap-2 group">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-400 shadow-[0_0_5px_rgba(251,191,36,0.5)] group-hover:scale-125 transition-transform"></span>
                                <span>🍜 Makanan</span>
                            </button>
                            <button type="button" onclick="selectAddCategory('minuman', '🥤 Minuman')" class="w-full text-left px-3 py-2.5 text-sm font-bold text-slate-700 hover:bg-blue-50 hover:text-brand-blue rounded-lg transition-colors flex items-center gap-2 group">
                                <span class="w-1.5 h-1.5 rounded-full bg-sky-400 shadow-[0_0_5px_rgba(56,189,248,0.5)] group-hover:scale-125 transition-transform"></span>
                                <span>🥤 Minuman</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-5">
                    <div>
                        <label class="block text-xs font-extrabold text-slate-500 uppercase mb-2 tracking-wider">Harga (Rp)</label>
                        <input type="number" name="price" class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 font-bold text-slate-800 focus:ring-2 focus:ring-brand-blue focus:border-brand-blue focus:outline-none transition-all shadow-sm" required placeholder="5000">
                    </div>
                    <div>
                        <label class="block text-xs font-extrabold text-slate-500 uppercase mb-2 tracking-wider">Stok Awal</label>
                        <input type="number" name="stock" class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 font-bold text-slate-800 focus:ring-2 focus:ring-brand-blue focus:border-brand-blue focus:outline-none transition-all shadow-sm" required placeholder="10">
                    </div>
                </div>

                <div class="mb-8">
                    <label class="block text-xs font-extrabold text-slate-500 uppercase mb-2 tracking-wider">Foto Menu (Opsional)</label>
                    <input type="file" name="image" class="block w-full text-sm text-slate-500 file:mr-4 file:py-3 file:px-4 file:rounded-l-xl file:border-0 file:text-sm file:font-extrabold file:bg-blue-50 file:text-brand-blue hover:file:bg-blue-100 border border-slate-200 rounded-xl cursor-pointer bg-slate-50 focus:outline-none focus:ring-2 focus:ring-brand-blue transition-all shadow-sm">
                    <p class="mt-2 text-[10px] text-slate-400 font-semibold">Format: JPG, PNG. Maksimal 2MB.</p>
                </div>

                <button type="submit" class="w-full bg-brand-blue hover:bg-blue-800 text-white py-4 rounded-xl font-extrabold text-base shadow-lg shadow-blue-900/20 hover:shadow-xl transition transform hover:-translate-y-0.5 tracking-wide">
                    SIMPAN DATA
                </button>
            </form>
        </div>
    </div>

    <div id="editProductModal" class="fixed inset-0 bg-slate-900/60 hidden flex items-center justify-center z-50 backdrop-blur-sm p-4 transition-opacity duration-300">
        <div class="bg-white w-full max-w-md rounded-[2rem] shadow-2xl overflow-hidden border border-slate-200 transform transition-all">

            <div class="bg-gradient-to-r from-[#1e448e] to-[#153166] px-6 py-5 flex justify-between items-center relative overflow-hidden">
                <div class="absolute right-0 top-0 w-24 h-24 bg-white/5 rounded-full blur-xl -mr-10 -mt-10"></div>
                <h3 class="text-lg font-extrabold text-white flex items-center gap-2 relative z-10">
                    <span>✏️</span> <span>Edit Menu</span>
                </h3>
                <button type="button" onclick="closeEditModal()" class="text-white/50 hover:text-white text-2xl leading-none relative z-10">&times;</button>
            </div>

            <form id="editForm" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf

                <div class="mb-5">
                    <label class="block text-xs font-extrabold text-slate-500 uppercase mb-2 tracking-wider">Nama Menu</label>
                    <input type="text" name="name" id="editName" class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 font-bold text-slate-800 focus:ring-2 focus:ring-brand-blue focus:border-brand-blue focus:outline-none transition-all shadow-sm" required>
                </div>

                <div class="mb-5 relative" id="editCategoryDropdownWrapper">
                    <label class="block text-xs font-extrabold text-slate-500 uppercase mb-2 tracking-wider">Kategori</label>
                    <input type="hidden" name="category" id="editCategoryInput">

                    <button type="button" onclick="toggleEditCategoryDropdown()" id="editCategoryBtn"
                        class="w-full flex items-center justify-between bg-slate-50 border border-slate-200 rounded-xl p-3 font-bold text-brand-blue focus:ring-2 focus:ring-brand-blue focus:border-brand-blue outline-none transition-all shadow-sm">
                        <span id="editCategoryText" class="flex items-center gap-2">Pilih Kategori...</span>
                        <svg class="w-5 h-5 text-slate-400 transition-transform duration-200 flex-shrink-0" id="editCategoryIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>

                    <div id="editCategoryMenu" class="absolute left-0 right-0 top-[85px] bg-white rounded-xl shadow-[0_10px_25px_-5px_rgba(0,0,0,0.1)] border border-slate-100 opacity-0 invisible scale-95 origin-top transition-all duration-200 z-50">
                        <div class="p-1.5 flex flex-col gap-0.5">
                            <button type="button" onclick="selectEditCategory('makanan', '🍜 Makanan')" class="w-full text-left px-3 py-2.5 text-sm font-bold text-slate-700 hover:bg-blue-50 hover:text-brand-blue rounded-lg transition-colors flex items-center gap-2 group">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-400 shadow-[0_0_5px_rgba(251,191,36,0.5)] group-hover:scale-125 transition-transform"></span>
                                <span>🍜 Makanan</span>
                            </button>
                            <button type="button" onclick="selectEditCategory('minuman', '🥤 Minuman')" class="w-full text-left px-3 py-2.5 text-sm font-bold text-slate-700 hover:bg-blue-50 hover:text-brand-blue rounded-lg transition-colors flex items-center gap-2 group">
                                <span class="w-1.5 h-1.5 rounded-full bg-sky-400 shadow-[0_0_5px_rgba(56,189,248,0.5)] group-hover:scale-125 transition-transform"></span>
                                <span>🥤 Minuman</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-5">
                    <div>
                        <label class="block text-xs font-extrabold text-slate-500 uppercase mb-2 tracking-wider">Harga (Rp)</label>
                        <input type="number" name="price" id="editPrice" class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 font-bold text-slate-800 focus:ring-2 focus:ring-brand-blue focus:border-brand-blue focus:outline-none transition-all shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-xs font-extrabold text-slate-500 uppercase mb-2 tracking-wider">Stok Saat Ini</label>
                        <input type="number" name="stock" id="editStock" class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 font-bold text-slate-800 focus:ring-2 focus:ring-brand-blue focus:border-brand-blue focus:outline-none transition-all shadow-sm" required>
                    </div>
                </div>

                <div class="mb-8">
                    <label class="block text-xs font-extrabold text-slate-500 uppercase mb-2 tracking-wider">Ganti Foto (Opsional)</label>
                    <input type="file" name="image" class="block w-full text-sm text-slate-500 file:mr-4 file:py-3 file:px-4 file:rounded-l-xl file:border-0 file:text-sm file:font-extrabold file:bg-blue-50 file:text-brand-blue hover:file:bg-blue-100 border border-slate-200 rounded-xl cursor-pointer bg-slate-50 focus:outline-none focus:ring-2 focus:ring-brand-blue transition-all shadow-sm">
                </div>

                <button type="submit" class="w-full bg-brand-blue hover:bg-blue-800 text-white py-4 rounded-xl font-extrabold text-base shadow-lg shadow-blue-900/20 hover:shadow-xl transition transform hover:-translate-y-0.5 tracking-wide">
                    UPDATE DATA
                </button>
            </form>
        </div>
    </div>

    <script>
        function toggleAddCategoryDropdown() {
            const menu = document.getElementById('addCategoryMenu');
            const icon = document.getElementById('addCategoryIcon');
            if (menu.classList.contains('opacity-0')) {
                menu.classList.remove('opacity-0', 'invisible', 'scale-95');
                menu.classList.add('opacity-100', 'visible', 'scale-100');
                icon.classList.add('rotate-180');
            } else {
                closeAddCategoryDropdown();
            }
        }

        function closeAddCategoryDropdown() {
            const menu = document.getElementById('addCategoryMenu');
            const icon = document.getElementById('addCategoryIcon');
            menu.classList.add('opacity-0', 'invisible', 'scale-95');
            menu.classList.remove('opacity-100', 'visible', 'scale-100');
            icon.classList.remove('rotate-180');
        }

        function selectAddCategory(value, text) {
            document.getElementById('addCategoryInput').value = value;
            document.getElementById('addCategoryText').innerHTML = `<span>${value === 'makanan' ? '🍜' : '🥤'}</span> ${value === 'makanan' ? 'Makanan' : 'Minuman'}`;
            closeAddCategoryDropdown();
        }

        function toggleEditCategoryDropdown() {
            const menu = document.getElementById('editCategoryMenu');
            const icon = document.getElementById('editCategoryIcon');
            if (menu.classList.contains('opacity-0')) {
                menu.classList.remove('opacity-0', 'invisible', 'scale-95');
                menu.classList.add('opacity-100', 'visible', 'scale-100');
                icon.classList.add('rotate-180');
            } else {
                closeEditCategoryDropdown();
            }
        }

        function closeEditCategoryDropdown() {
            const menu = document.getElementById('editCategoryMenu');
            const icon = document.getElementById('editCategoryIcon');
            menu.classList.add('opacity-0', 'invisible', 'scale-95');
            menu.classList.remove('opacity-100', 'visible', 'scale-100');
            icon.classList.remove('rotate-180');
        }

        function selectEditCategory(value, text) {
            document.getElementById('editCategoryInput').value = value;
            document.getElementById('editCategoryText').innerHTML = `<span>${value === 'makanan' ? '🍜' : '🥤'}</span> ${value === 'makanan' ? 'Makanan' : 'Minuman'}`;
            closeEditCategoryDropdown();
        }

        document.addEventListener('click', function(event) {
            const addWrapper = document.getElementById('addCategoryDropdownWrapper');
            if (addWrapper && !addWrapper.contains(event.target)) {
                closeAddCategoryDropdown();
            }
            const editWrapper = document.getElementById('editCategoryDropdownWrapper');
            if (editWrapper && !editWrapper.contains(event.target)) {
                closeEditCategoryDropdown();
            }
        });


        function openEditModal(id, name, category, price, stock) {
            document.getElementById('editName').value = name;
            document.getElementById('editPrice').value = price;
            document.getElementById('editStock').value = stock;

            document.getElementById('editCategoryInput').value = category;
            if (category === 'makanan') {
                document.getElementById('editCategoryText').innerHTML = '<span>🍜</span> Makanan';
            } else {
                document.getElementById('editCategoryText').innerHTML = '<span>🥤</span> Minuman';
            }

            document.getElementById('editForm').action = "/fnb/update/" + id;

            document.getElementById('editProductModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editProductModal').classList.add('hidden');
        }
    </script>
@endsection
