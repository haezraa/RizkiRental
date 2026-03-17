@extends('layouts.main')

@section('judul_halaman', 'Manajemen Akun Billing')

@section('konten')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 h-fit">
            <h3 class="font-bold text-lg mb-4 text-gray-800">Buat Akun Billing Baru</h3>
            <form action="{{ route('members.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nama Asli</label>
                    <input type="text" name="name" class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500" required placeholder="Contoh: Budi Sudarsono">
                </div>
                <div class="mb-4">
                    <label class="block text-xs font-bold text-blue-600 uppercase mb-1">Username Billing</label>
                    <input type="text" name="username_billing" class="w-full border border-blue-300 bg-blue-50 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500" required placeholder="Tanpa spasi (Cth: budi123)">
                </div>
                <div class="mb-4">
                    <label class="block text-xs font-bold text-green-600 uppercase mb-1">Isi Saldo Waktu (Menit)</label>
                    <input type="number" name="saldo_menit" class="w-full border border-green-300 bg-green-50 rounded-lg p-2.5 focus:ring-2 focus:ring-green-500" required placeholder="Cth: 300 (Untuk 5 Jam)">
                    <p class="text-[10px] text-gray-400 mt-1">*1 Jam = 60 Menit</p>
                </div>
                <div class="mb-4">
                    <label class="block text-xs font-bold text-purple-600 uppercase mb-1">Tipe Unit (Class)</label>
                    <select name="console_type" class="w-full border border-purple-300 bg-purple-50 rounded-lg p-2.5 focus:ring-2 focus:ring-purple-500" required>
                        <option value="PS 3">PLAYSTATION 3</option>
                        <option value="PS 4">PLAYSTATION 4</option>
                        <option value="PS 5">PLAYSTATION 5</option>
                    </select>
                </div>
                <div class="mb-6">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">No. HP / WA (Opsional)</label>
                    <input type="number" name="phone" class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500" placeholder="0812...">
                </div>
                <button type="submit" class="w-full bg-[#2251a5] text-white py-3 rounded-xl font-bold hover:bg-blue-800 transition shadow-lg">
                    Simpan & Aktifkan Akun
                </button>
            </form>
        </div>

        <div class="md:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Member</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Username Billing</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase text-center">Class</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase text-center">Sisa Waktu</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($members as $member)
                        <tr class="hover:bg-blue-50/50 transition">
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-800">{{ $member->name }}</div>
                                <div class="text-[10px] text-gray-400">{{ $member->phone ?? 'Tidak ada No. HP' }}</div>
                            </td>
                            <td class="px-6 py-4 font-mono font-bold text-blue-600">{{ $member->username_billing }}</td>

                            <td class="px-6 py-4 text-center">
                                <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-[10px] font-black tracking-wider uppercase">
                                    {{ $member->console_type }}
                                </span>
                            </td>

                            @php
                                $jam = floor($member->saldo_menit / 60);
                                $menit = $member->saldo_menit % 60;
                            @endphp

                            <td class="px-6 py-4 text-center">
                                @if($member->saldo_menit > 0)
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-black">
                                        {{ $jam }}j {{ $menit }}m
                                    </span>
                                @else
                                    <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-black">HABIS</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button type="button"
    onclick="openTopupModal('{{ $member->id }}', '{{ $member->name }}', '{{ $member->username_billing }}')"
    class="text-blue-600 hover:text-blue-800 font-bold text-xs bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-lg transition border border-blue-200">
    Top Up
</button>

                                    <form id="deleteMember-{{ $member->id }}" action="{{ route('members.destroy', $member->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            onclick="openConfirm('Yakin ingin menghapus akun {{ $member->username_billing }}?', 'deleteMember-{{ $member->id }}')"
                                            class="text-red-500 hover:text-red-700 font-bold text-xs bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-6 py-8 text-center text-gray-400 italic">Belum ada akun billing yang terdaftar.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div id="modalTopup" class="fixed inset-0 bg-black/60 hidden flex items-center justify-center z-[99] backdrop-blur-sm p-4 transition-opacity duration-300">
        <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl border border-gray-200 flex flex-col max-h-[85vh] overflow-hidden transform transition-all scale-100">

            <div class="bg-[#2251a5] px-6 py-4 flex justify-between items-center flex-shrink-0 z-20 shadow-md">
                <h3 class="text-lg font-bold text-white flex items-center gap-2">
                <span id="modalTitle">Top Up Waktu</span>
                </h3>
                <button type="button" onclick="closeTopupModal()" class="text-white/70 hover:text-white text-2xl leading-none transition">&times;</button>
            </div>

            <div class="overflow-y-auto scrollbar-hide flex-1 bg-white relative">
                <form id="formTopup" method="POST" class="p-6 text-gray-800">
                    @csrf

                    <div class="mb-6 text-center bg-blue-50 p-4 rounded-xl border border-blue-100 shadow-sm">
                        <p class="text-xs text-blue-500 font-bold uppercase mb-1">Target Akun Top Up</p>
                        <p class="text-xl font-black text-[#2251a5] leading-none mb-1.5" id="topupMemberName">-</p>
                        <p class="text-sm font-mono text-blue-600 font-bold inline-block bg-white px-3 py-1 rounded-md border border-blue-200" id="topupMemberUsername">-</p>
                    </div>

                    <div class="mb-6">
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Tambah Saldo Waktu (Menit)</label>
                        <input type="number" name="tambah_menit" class="w-full bg-gray-50 border border-gray-300 text-[#2251a5] font-black rounded-lg p-3 focus:ring-2 focus:ring-[#2251a5] focus:outline-none text-center text-2xl transition" required placeholder="0">
                        <p class="text-xs font-bold text-gray-400 mt-2 text-center">💡 1 Jam = 60 Menit (Ketik dalam format menit)</p>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="w-full bg-[#2251a5] hover:bg-blue-800 text-white py-3.5 rounded-xl font-bold text-lg shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                            TOP UP
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openTopupModal(id, name, username) {
            const modal = document.getElementById('modalTopup');

            document.getElementById('topupMemberName').innerText = name;
            document.getElementById('topupMemberUsername').innerText = username;

            document.getElementById('formTopup').action = '/members/' + id + '/topup';

            modal.classList.remove('hidden');
        }

        function closeTopupModal() {
            document.getElementById('modalTopup').classList.add('hidden');
        }
    </script>
@endsection
