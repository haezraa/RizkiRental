@extends('parts.layout')

@section('judul_halaman', 'Data Player & Saldo Waktu')

@section('konten')

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-xl bg-slate-50 text-slate-600 flex items-center justify-center flex-shrink-0 border border-slate-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <div>
                <p class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider mb-0.5">Total Player</p>
                <h4 class="text-2xl font-black text-slate-800">{{ $users->count() }}</h4>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0 border border-blue-100">
                <span class="font-black text-sm">PS3</span>
            </div>
            <div>
                <p class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider mb-0.5">Punya Saldo PS3</p>
                <h4 class="text-2xl font-black text-slate-800">{{ $users->where('saldo_ps3', '>', 0)->count() }}</h4>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center flex-shrink-0 border border-indigo-100">
                <span class="font-black text-sm">PS4</span>
            </div>
            <div>
                <p class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider mb-0.5">Punya Saldo PS4</p>
                <h4 class="text-2xl font-black text-slate-800">{{ $users->where('saldo_ps4', '>', 0)->count() }}</h4>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center flex-shrink-0 border border-purple-100">
                <span class="font-black text-sm">PS5</span>
            </div>
            <div>
                <p class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider mb-0.5">Punya Saldo PS5</p>
                <h4 class="text-2xl font-black text-slate-800">{{ $users->where('saldo_ps5', '>', 0)->count() }}</h4>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden flex flex-col">

        <div class="p-5 border-b border-slate-100 bg-white flex flex-col sm:flex-row justify-between items-center gap-4 relative overflow-hidden z-10">
            <div class="flex items-center gap-3">
                <h3 class="font-extrabold text-slate-800 text-lg tracking-tight">
                     Daftar Akun
                </h3>
            </div>

            <div class="relative w-full sm:w-72">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Cari nama atau email..."
                    class="w-full pl-10 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-slate-700 focus:outline-none focus:ring-2 focus:ring-brand-blue focus:border-brand-blue transition-all">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse" id="playerTable">
                <thead class="bg-slate-50/80 backdrop-blur-sm border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-5 font-extrabold text-xs text-slate-400 uppercase tracking-wider">Info Player</th>
                        <th class="px-6 py-5 font-extrabold text-xs text-slate-400 uppercase tracking-wider text-center">Saldo PS 3</th>
                        <th class="px-6 py-5 font-extrabold text-xs text-slate-400 uppercase tracking-wider text-center">Saldo PS 4</th>
                        <th class="px-6 py-5 font-extrabold text-xs text-slate-400 uppercase tracking-wider text-center">Saldo PS 5</th>
                        <th class="px-6 py-5 font-extrabold text-xs text-slate-400 uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($users as $user)
                        <tr class="hover:bg-blue-50/30 transition-colors group player-row">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#1e448e] to-[#153166] text-white flex items-center justify-center font-black shadow-sm flex-shrink-0">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="font-extrabold text-slate-800 tracking-tight text-base mb-0.5 player-name">{{ $user->name }}</div>
                                        <div class="text-[11px] text-slate-400 font-bold tracking-wide player-email">{{ $user->email }} • Gabung: {{ $user->created_at->format('d M Y') }}</div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-center">
                                @if($user->saldo_ps3 > 0)
                                    <span class="inline-flex items-center justify-center bg-blue-50 text-blue-700 border border-blue-200/60 px-3 py-1.5 rounded-xl text-xs font-black shadow-sm min-w-[70px]">
                                        {{ floor($user->saldo_ps3 / 60) }}j {{ $user->saldo_ps3 % 60 }}m
                                    </span>
                                @else
                                    <span class="text-slate-300 text-xs font-extrabold">-</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-center">
                                @if($user->saldo_ps4 > 0)
                                    <span class="inline-flex items-center justify-center bg-indigo-50 text-indigo-700 border border-indigo-200/60 px-3 py-1.5 rounded-xl text-xs font-black shadow-sm min-w-[70px]">
                                        {{ floor($user->saldo_ps4 / 60) }}j {{ $user->saldo_ps4 % 60 }}m
                                    </span>
                                @else
                                    <span class="text-slate-300 text-xs font-extrabold">-</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-center">
                                @if($user->saldo_ps5 > 0)
                                    <span class="inline-flex items-center justify-center bg-purple-50 text-purple-700 border border-purple-200/60 px-3 py-1.5 rounded-xl text-xs font-black shadow-sm min-w-[70px]">
                                        {{ floor($user->saldo_ps5 / 60) }}j {{ $user->saldo_ps5 % 60 }}m
                                    </span>
                                @else
                                    <span class="text-slate-300 text-xs font-extrabold">-</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-center">
                                <button onclick="openEditSaldoModal('{{ $user->id }}', '{{ $user->name }}', '{{ $user->saldo_ps3 }}', '{{ $user->saldo_ps4 }}', '{{ $user->saldo_ps5 }}')"
                                    class="w-8 h-8 bg-slate-100 text-slate-500 hover:bg-brand-blue hover:text-white rounded-lg flex items-center justify-center transition-all mx-auto" title="Edit Saldo Manual">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr id="emptyState">
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-slate-400">
                                    <svg class="w-12 h-12 mb-3 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                    <p class="font-bold text-sm">Belum ada player yang mendaftar.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse

                    <tr id="noSearchResult" class="hidden">
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center text-slate-400">
                                <svg class="w-12 h-12 mb-3 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                <p class="font-bold text-sm">Player tidak ditemukan.</p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div id="editSaldoModal" class="fixed inset-0 bg-slate-900/60 hidden flex items-center justify-center z-50 backdrop-blur-sm p-4 transition-opacity duration-300">
        <div class="bg-white w-full max-w-sm rounded-[2rem] shadow-2xl overflow-hidden border border-slate-200 transform transition-all">

            <div class="bg-gradient-to-r from-[#1e448e] to-[#153166] px-6 py-5 flex justify-between items-center relative overflow-hidden">
                <div class="absolute right-0 top-0 w-24 h-24 bg-white/5 rounded-full blur-xl -mr-10 -mt-10"></div>
                <h3 class="text-lg font-extrabold text-white flex items-center gap-2 relative z-10">
                    <span>⏱️</span> <span>Edit Saldo Player</span>
                </h3>
                <button type="button" onclick="closeEditSaldoModal()" class="text-white/50 hover:text-white text-2xl leading-none relative z-10">&times;</button>
            </div>

            <form id="formEditSaldo" action="#" method="POST" class="p-6">
                @csrf
                @method('PATCH')

                <div class="mb-5 text-center">
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-1">Nama Player</p>
                    <p id="modalPlayerName" class="text-xl font-black text-[#1e448e]">-</p>
                </div>

                <div class="space-y-4 mb-6">
                    <div>
                        <label class="block text-xs font-extrabold text-slate-500 uppercase mb-2 tracking-wider">Saldo PS3 (Menit)</label>
                        <input type="number" name="saldo_ps3" id="modalPs3" class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 font-bold text-slate-800 focus:ring-2 focus:ring-brand-blue focus:outline-none transition-all shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-xs font-extrabold text-slate-500 uppercase mb-2 tracking-wider">Saldo PS4 (Menit)</label>
                        <input type="number" name="saldo_ps4" id="modalPs4" class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 font-bold text-slate-800 focus:ring-2 focus:ring-brand-blue focus:outline-none transition-all shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-xs font-extrabold text-slate-500 uppercase mb-2 tracking-wider">Saldo PS5 (Menit)</label>
                        <input type="number" name="saldo_ps5" id="modalPs5" class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 font-bold text-slate-800 focus:ring-2 focus:ring-brand-blue focus:outline-none transition-all shadow-sm" required>
                    </div>
                </div>

                <div class="bg-blue-50 border border-blue-100 p-3 rounded-xl mb-6">
                    <p class="text-[10px] text-brand-blue font-bold text-center leading-relaxed">
                        ⚠️ <strong class="font-black">Peringatan:</strong> Mengubah saldo disini akan langsung mengubah database player. Pastikan angka dalam satuan <strong>Menit</strong>.
                    </p>
                </div>

                <button type="submit" class="w-full bg-brand-blue hover:bg-blue-800 text-white py-3.5 rounded-xl font-extrabold text-sm shadow-lg shadow-blue-900/20 hover:shadow-xl transition transform hover:-translate-y-0.5 tracking-wide">
                    SIMPAN PERUBAHAN
                </button>
            </form>
        </div>
    </div>

    <script>
        function filterTable() {
            let input = document.getElementById("searchInput");
            let filter = input.value.toLowerCase();
            let table = document.getElementById("playerTable");
            let rows = table.getElementsByClassName("player-row");
            let visibleCount = 0;

            for (let i = 0; i < rows.length; i++) {
                let name = rows[i].querySelector(".player-name").innerText.toLowerCase();
                let email = rows[i].querySelector(".player-email").innerText.toLowerCase();

                if (name.includes(filter) || email.includes(filter)) {
                    rows[i].style.display = "";
                    visibleCount++;
                } else {
                    rows[i].style.display = "none";
                }
            }

            let noResultRow = document.getElementById("noSearchResult");
            if (visibleCount === 0 && rows.length > 0) {
                noResultRow.classList.remove("hidden");
            } else {
                noResultRow.classList.add("hidden");
            }
        }

        function openEditSaldoModal(id, name, ps3, ps4, ps5) {
            document.getElementById('modalPlayerName').innerText = name;
            document.getElementById('modalPs3').value = ps3;
            document.getElementById('modalPs4').value = ps4;
            document.getElementById('modalPs5').value = ps5;

            document.getElementById('editSaldoModal').classList.remove('hidden');
        }

        function closeEditSaldoModal() {
            document.getElementById('editSaldoModal').classList.add('hidden');
        }
    </script>
@endsection
