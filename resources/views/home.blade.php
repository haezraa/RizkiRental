@extends('layouts.main')

@section('judul_halaman', 'Home')

@section('konten')

    <div class="bg-[#2251a5] rounded-2xl p-6 text-white shadow-lg mb-8 flex justify-between items-center relative overflow-hidden">
        <div class="relative z-10">
            <h2 class="text-3xl font-black mb-1">Halo, Admin!</h2>
            <p class="text-blue-200 text-sm">Semoga hari ini rental ramai dan lancar ya!</p>
        </div>
        <svg class="w-32 h-32 absolute -right-4 -bottom-8 text-white/10 rotate-12" fill="currentColor" viewBox="0 0 24 24"><path d="M21 6H3c-1.1 0-2 .9-2 2v8c0 1.1.9 2 2 2h18c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-10 7H4.41c.62-1.29 1.61-2.31 2.85-2.97V7h2.48v3.03c1.24.66 2.23 1.68 2.85 2.97H11v-3zM8 11.5c0-.83-.67-1.5-1.5-1.5S5 10.67 5 11.5s.67 1.5 1.5 1.5 1.5-.67 1.5-1.5zm11 1.5h-2.41c-.62 1.29-1.61 2.31-2.85 2.97V17h-2.48v-3.03c-1.24-.66-2.23-1.68-2.85-2.97H19v3zm-1.5-1.5c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5.67 1.5 1.5 1.5 1.5-.67 1.5-1.5z"/></svg>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-green-100 text-green-600 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-bold uppercase">Pemasukan Hari Ini</p>
                <h3 class="text-2xl font-black text-gray-800">Rp {{ number_format($pemasukan_hari_ini ?? 0, 0, ',', '.') }}</h3>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path></svg>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-bold uppercase">Unit Sedang Main</p>
                <h3 class="text-2xl font-black text-gray-800">{{ $unit_sedang_main ?? 0 }} <span class="text-sm font-medium text-gray-400">Unit</span></h3>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-bold uppercase">Total Pelanggan</p>
                <h3 class="text-2xl font-black text-gray-800">{{ $total_transaksi ?? 0 }} <span class="text-sm font-medium text-gray-400">Orang</span></h3>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Riwayat Aktivitas Terakhir</h3>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-gray-400 border-b border-gray-100">
                        <th class="pb-3 font-semibold text-xs uppercase">Jam</th>
                        <th class="pb-3 font-semibold text-xs uppercase">Player</th>
                        <th class="pb-3 font-semibold text-xs uppercase">Unit</th>
                        <th class="pb-3 font-semibold text-xs uppercase">Durasi</th>
                        <th class="pb-3 font-semibold text-xs uppercase text-center">Paket</th> <th class="pb-3 font-semibold text-xs uppercase text-right">Total</th>
                        <th class="pb-3 font-semibold text-xs uppercase text-right">Status</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @forelse($riwayat_terbaru ?? [] as $history)
                        <tr class="border-b border-gray-50 last:border-0 hover:bg-gray-50 transition">
                            <td class="py-3 text-gray-500">{{ $history->created_at->format('H:i') }}</td>
                            <td class="py-3 font-bold text-gray-800">{{ $history->customer_name }}</td>
                            <td class="py-3 text-[#2251a5] font-bold">
                                {{ $history->console ? $history->console->name : 'Unit Dihapus' }}
                            </td>

                            <td class="py-3 text-gray-500">
                                @if(isset($history->is_begadang) && $history->is_begadang == 1)
                                    <span class="text-xs bg-blue-50 text-[#2251a5] font-bold px-2 py-1 rounded">PAKET</span>
                                @else
                                    {{ floor($history->duration_minutes / 60) }} Jam
                                @endif
                            </td>

                            <td class="py-3 text-center">
                                @if(isset($history->is_begadang) && $history->is_begadang == 1)
                                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-green-100 text-green-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    </span>
                                @else
                                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-gray-100 text-gray-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </span>
                                @endif
                            </td>

                            <td class="py-3 text-gray-800 font-bold text-right">Rp {{ number_format($history->total_price, 0, ',', '.') }}</td>
                            <td class="py-3 text-right">
                                @if($history->status == 'finished')
                                    <span class="bg-green-100 text-green-600 py-1 px-3 rounded-full text-xs font-bold">Selesai</span>
                                @elseif($history->status == 'ongoing')
                                    <span class="bg-blue-100 text-blue-600 py-1 px-3 rounded-full text-xs font-bold">Main</span>
                                @else
                                    <span class="bg-yellow-100 text-yellow-600 py-1 px-3 rounded-full text-xs font-bold">Paused</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-gray-400 italic">Belum ada aktivitas hari ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
