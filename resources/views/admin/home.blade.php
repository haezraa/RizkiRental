@extends('parts.layout')

@section('judul_halaman', 'Dashboard')

@section('konten')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

        <div class="lg:col-span-2 bg-brand-blue rounded-xl p-6 text-white shadow-sm flex justify-between items-center relative overflow-hidden">
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-2">
                    <span class="bg-white/10 px-2.5 py-1 rounded text-xs font-semibold uppercase tracking-wider" id="realtimeDate">
                        {{ \Carbon\Carbon::now('Asia/Jakarta')->translatedFormat('l, d F Y') }}
                    </span>
                    <span class="text-blue-200 text-xs font-bold font-mono tracking-wider" id="realtimeClock">
                        00:00:00 WIB
                    </span>
                </div>
                <h2 class="text-2xl font-bold mb-1">Selamat Datang, {{ Auth::user()->name ?? 'Admin' }}</h2>
                <p class="text-blue-100 text-sm">Pantau aktivitas rental dan ketersediaan unit hari ini.</p>
            </div>

            <div class="hidden md:block opacity-20">
                <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M21 6H3c-1.1 0-2 .9-2 2v8c0 1.1.9 2 2 2h18c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-10 7H4.41c.62-1.29 1.61-2.31 2.85-2.97V7h2.48v3.03c1.24.66 2.23 1.68 2.85 2.97H11v-3zM8 11.5c0-.83-.67-1.5-1.5-1.5S5 10.67 5 11.5s.67 1.5 1.5 1.5 1.5-.67 1.5-1.5zm11 1.5h-2.41c-.62 1.29-1.61 2.31-2.85 2.97V17h-2.48v-3.03c-1.24-.66-2.23-1.68-2.85-2.97H19v3zm-1.5-1.5c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5.67 1.5 1.5 1.5 1.5-.67 1.5-1.5z"/></svg>
            </div>
        </div>

        <div class="bg-yellow-50 rounded-xl border border-yellow-200 p-4 shadow-sm flex flex-col relative">
            <div class="flex justify-between items-center mb-2">
                <h3 class="text-sm font-bold text-yellow-800 flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Catatan Shift Admin
                </h3>
                <button onclick="clearMemo()" class="text-[10px] uppercase font-bold text-yellow-600 hover:text-yellow-800 bg-yellow-100 px-2 py-0.5 rounded">Hapus</button>
            </div>
            <textarea id="adminMemo" class="flex-1 w-full bg-transparent border-none focus:ring-0 text-yellow-900 placeholder-yellow-600/50 resize-none text-sm p-0" placeholder="Ketik catatan pergantian shift atau pengingat di sini... (Tersimpan otomatis)"></textarea>
        </div>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-200 flex items-center gap-4">
            <div class="w-12 h-12 rounded-lg bg-green-100 text-green-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-xs text-slate-500 font-bold uppercase mb-0.5">Pemasukan Hari Ini</p>
                <h3 class="text-2xl font-bold text-slate-800">Rp {{ number_format($pemasukan_hari_ini ?? 0, 0, ',', '.') }}</h3>
            </div>
        </div>

        <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-200 flex items-center gap-4">
            <div class="w-12 h-12 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path></svg>
            </div>
            <div>
                <p class="text-xs text-slate-500 font-bold uppercase mb-0.5">Unit Sedang Main</p>
                <h3 class="text-2xl font-bold text-slate-800">{{ $unit_sedang_main ?? 0 }} <span class="text-sm font-medium text-slate-400">Unit</span></h3>
            </div>
        </div>

        <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-200 flex items-center gap-4">
            <div class="w-12 h-12 rounded-lg bg-purple-100 text-purple-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
            </div>
            <div>
                <p class="text-xs text-slate-500 font-bold uppercase mb-0.5">Total Sesi Main</p>
                <h3 class="text-2xl font-bold text-slate-800">{{ $total_transaksi ?? 0 }} <span class="text-sm font-medium text-slate-400">Sesi</span></h3>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-5 border-b border-slate-200 flex justify-between items-center bg-slate-50">
            <h3 class="text-base font-bold text-slate-800">Aktivitas Terakhir</h3>
            <a href="{{ route('reports.index') }}" class="text-xs font-bold text-brand-blue hover:text-blue-800">Lihat Semua Laporan &rarr;</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-slate-500 border-b border-slate-200">
                        <th class="py-3 px-5 font-semibold text-xs uppercase">Jam</th>
                        <th class="py-3 px-5 font-semibold text-xs uppercase">Player</th>
                        <th class="py-3 px-5 font-semibold text-xs uppercase">Unit / Paket</th>
                        <th class="py-3 px-5 font-semibold text-xs uppercase text-right">Total Bayar</th>
                        <th class="py-3 px-5 font-semibold text-xs uppercase text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-slate-100">
                    @forelse($riwayat_terbaru ?? [] as $history)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-3 px-5 text-slate-600">{{ $history->created_at->format('H:i') }}</td>
                            <td class="py-3 px-5 font-bold text-slate-800">{{ $history->customer_name }}</td>
                            <td class="py-3 px-5">
                                <div class="flex items-center gap-2">
                                    <span class="text-brand-blue font-bold">
                                        {{ $history->console ? $history->console->name : 'TV Dihapus' }}
                                    </span>
                                    <span class="text-slate-300">|</span>
                                    @if(isset($history->is_begadang) && $history->is_begadang == 1)
                                        <span class="text-[11px] bg-indigo-50 text-indigo-700 font-bold px-2 py-0.5 rounded border border-indigo-100">BEGADANG</span>
                                    @else
                                        <span class="text-slate-600 text-xs">{{ floor($history->duration_minutes / 60) }} Jam</span>
                                    @endif
                                </div>
                            </td>
                            <td class="py-3 px-5 text-right font-semibold text-slate-800">
                                Rp {{ number_format($history->total_price, 0, ',', '.') }}
                            </td>
                            <td class="py-3 px-5 text-center">
                                @if($history->status == 'finished')
                                    <span class="bg-green-100 text-green-700 py-1 px-2.5 rounded text-xs font-semibold">Selesai</span>
                                @elseif($history->status == 'ongoing')
                                    <span class="bg-blue-100 text-blue-700 py-1 px-2.5 rounded text-xs font-semibold">Main</span>
                                @else
                                    <span class="bg-yellow-100 text-yellow-700 py-1 px-2.5 rounded text-xs font-semibold">Paused</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-slate-400 text-sm">Belum ada aktivitas sewa hari ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function updateClock() {
            const now = new Date();
            document.getElementById('realtimeClock').textContent = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit', timeZone: 'Asia/Jakarta' }) + ' WIB';
        }
        setInterval(updateClock, 1000);
        updateClock();

        const memoArea = document.getElementById('adminMemo');
        memoArea.value = localStorage.getItem('adminMemo') || '';

        memoArea.addEventListener('input', function() {
            localStorage.setItem('adminMemo', this.value);
        });

        function clearMemo() {
            if(confirm('Hapus catatan ini?')) {
                localStorage.removeItem('adminMemo');
                memoArea.value = '';
            }
        }
    </script>
@endsection
