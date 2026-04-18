@extends('layouts.main')

@section('judul_halaman', 'Laporan & Riwayat')

@section('konten')

    <div class="mb-8">
        <form action="{{ route('reports.index') }}" method="GET" class="bg-white p-4 rounded-xl shadow-sm border border-gray-200 flex flex-wrap items-end gap-4 mb-6">
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Dari Tanggal</label>
                <input type="date" name="start_date" value="{{ $startDate->format('Y-m-d') }}" class="bg-gray-50 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 font-semibold text-gray-700">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Sampai Tanggal</label>
                <input type="date" name="end_date" value="{{ $endDate->format('Y-m-d') }}" class="bg-gray-50 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 font-semibold text-gray-700">
            </div>
            <button type="submit" class="bg-[#2251a5] hover:bg-blue-700 text-white px-6 py-2.5 rounded-lg font-bold text-sm shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all">
                Tampilkan Data
            </button>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-gradient-to-br from-green-500 to-green-600 text-white p-6 rounded-2xl shadow-lg flex items-center justify-between border border-green-400">
                <div>
                    <p class="text-green-100 text-sm font-bold uppercase tracking-wider">Total Pemasukan</p>
                    <h3 class="text-4xl font-black mt-1 drop-shadow-sm">Rp {{ number_format($total_income, 0, ',', '.') }}</h3>
                </div>
                <div class="bg-white/20 p-4 rounded-full backdrop-blur-sm">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <div class="bg-gradient-to-br from-[#1a3d7c] to-[#2251a5] text-white p-6 rounded-2xl shadow-lg flex items-center justify-between border border-blue-400">
                <div>
                    <p class="text-blue-200 text-sm font-bold uppercase tracking-wider">Total Transaksi</p>
                    <h3 class="text-4xl font-black mt-1 drop-shadow-sm">{{ $total_transaksi }} <span class="text-lg font-medium text-blue-100">Sesi Main</span></h3>
                </div>
                <div class="bg-white/20 p-4 rounded-full backdrop-blur-sm">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-[0_4px_20px_rgb(0,0,0,0.03)] border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/80 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 font-black text-xs text-gray-500 uppercase tracking-wider">Tanggal & Jam</th>
                        <th class="px-6 py-4 font-black text-xs text-gray-500 uppercase tracking-wider">Nama Player</th>
                        <th class="px-6 py-4 font-black text-xs text-gray-500 uppercase tracking-wider">Unit</th>
                        <th class="px-6 py-4 font-black text-xs text-gray-500 uppercase tracking-wider">Durasi</th>
                        <th class="px-6 py-4 font-black text-xs text-gray-500 uppercase tracking-wider text-right">Total Bayar</th>
                        <th class="px-6 py-4 font-black text-xs text-gray-500 uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($transactions as $trans)
                        <tr class="hover:bg-blue-50/50 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-800">{{ $trans->created_at->format('d M Y') }}</div>
                                <div class="text-xs text-gray-500 font-medium">{{ $trans->created_at->format('H:i') }} WIB</div>
                            </td>
                            <td class="px-6 py-4 font-black text-gray-800">{{ $trans->customer_name }}</td>

                            <td class="px-6 py-4">
                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-md text-xs font-bold border border-gray-200">
                                    @if($trans->console)
                                        {{ $trans->console->name }} ({{ $trans->console->type }})
                                    @else
                                        Unit Dihapus
                                    @endif
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if(isset($trans->is_begadang) && $trans->is_begadang)
                                    <span class="text-xs bg-indigo-100 text-indigo-700 font-bold px-2.5 py-1 rounded-md border border-indigo-200">Paket Begadang</span>
                                @else
                                    <span class="text-gray-600 font-medium">{{ floor($trans->duration_minutes / 60) }} Jam</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-black text-[#2251a5] text-right">Rp {{ number_format($trans->total_price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-center">
                                <button onclick="document.getElementById('detailModal-{{ $trans->id }}').classList.remove('hidden')" class="bg-white border border-gray-300 text-gray-700 hover:text-[#2251a5] hover:border-[#2251a5] px-3 py-1.5 rounded-lg font-bold text-xs shadow-sm transition-all group-hover:shadow">
                                    Rincian
                                </button>
                            </td>
                        </tr>

                        <div id="detailModal-{{ $trans->id }}" class="fixed inset-0 bg-slate-900/70 hidden flex items-center justify-center z-50 backdrop-blur-sm p-4 transition-opacity">
                            <div class="bg-white w-full max-w-sm rounded-xl shadow-2xl overflow-hidden flex flex-col max-h-[90vh]">

                                <div class="bg-[#2251a5] px-5 py-4 flex justify-between items-center text-white">
                                    <h3 class="font-bold text-lg flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        Rincian Transaksi
                                    </h3>
                                    <button onclick="document.getElementById('detailModal-{{ $trans->id }}').classList.add('hidden')" class="text-blue-200 hover:text-white text-2xl font-bold leading-none">&times;</button>
                                </div>

                                <div id="strukContent-{{ $trans->id }}" class="p-6 overflow-y-auto bg-white text-black font-mono text-sm relative">

                                    <div class="text-center mb-5 struk-header">
                                        <h2 class="font-black text-2xl tracking-tight leading-none mb-1 text-center">RIZKI RENTAL PS</h2>
                                        <p class="text-sm text-gray-600 text-center">Rental PS Terbaik Tangerang</p>
                                        <div class="border-b-2 border-dashed border-gray-400 mt-4 mb-2"></div>
                                    </div>

                                    <div class="space-y-1 mb-4 text-xs font-semibold struk-info">
                                        <div class="flex justify-between">
                                            <span>TRX ID:</span>
                                            <span>#TRX-{{ str_pad($trans->id, 5, '0', STR_PAD_LEFT) }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span>Tanggal:</span>
                                            <span>{{ $trans->created_at->format('d/m/Y H:i') }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span>Kasir:</span>
                                            <span>Admin</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span>Player:</span>
                                            <span class="uppercase">{{ $trans->customer_name }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span>Console:</span>
                                            <span>
                                                @if($trans->console)
                                                    {{ $trans->console->name }} ({{ $trans->console->type }})
                                                @else
                                                    -
                                                @endif
                                            </span>
                                        </div>
                                    </div>

                                    <div class="border-b-2 border-dashed border-gray-400 mb-3 mt-3"></div>

                                    <div class="space-y-2 text-xs struk-items">
                                        <div class="flex justify-between items-start">
                                            <div class="flex-1">
                                                @if(isset($trans->is_begadang) && $trans->is_begadang)
                                                    <div class="font-bold">PAKET BEGADANG</div>
                                                    <div class="text-[10px] text-gray-500">S/D 06:00 WIB</div>
                                                @else
                                                    <div class="font-bold">SEWA RENTAL</div>
                                                    <div class="text-[10px] text-gray-500">{{ floor($trans->duration_minutes / 60) }} JAM</div>
                                                @endif
                                            </div>
                                            <div class="font-bold text-right">
                                                @php
                                                    $fnbTotal = $trans->details->sum('subtotal');
                                                    $rentalPrice = $trans->total_price - $fnbTotal;
                                                @endphp
                                                {{ number_format($rentalPrice, 0, ',', '.') }}
                                            </div>
                                        </div>

                                        @foreach($trans->details as $detail)
                                            <div class="flex justify-between items-start mt-2">
                                                <div class="flex-1">
                                                    <div class="font-bold uppercase">{{ $detail->product ? $detail->product->name : 'ITEM DIHAPUS' }}</div>
                                                    <div class="text-[10px] text-gray-500">{{ $detail->quantity }}x @ {{ number_format($detail->price, 0, ',', '.') }}</div>
                                                </div>
                                                <div class="font-bold text-right mt-3">
                                                    {{ number_format($detail->subtotal, 0, ',', '.') }}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="border-b-2 border-dashed border-gray-400 mb-4 mt-4"></div>

                                    <div class="flex justify-between items-center text-sm mb-6 struk-total">
                                        <span class="font-black">TOTAL BAYAR</span>
                                        <span class="font-black text-lg">Rp {{ number_format($trans->total_price, 0, ',', '.') }}</span>
                                    </div>

                                    <div class="text-center text-[10px] text-gray-600 space-y-1 font-bold struk-footer">
                                        <p>TERIMA KASIH TELAH BERMAIN</p>
                                        <p>DI RIZKI RENTAL PS</p>
                                        <p class="mt-2 text-xs">-- LUNAS --</p>
                                    </div>
                                </div>

                                <div class="bg-gray-50 px-5 py-4 border-t border-gray-200 flex justify-end gap-3 rounded-b-xl">
                                    <button onclick="document.getElementById('detailModal-{{ $trans->id }}').classList.add('hidden')" class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 font-bold text-sm hover:bg-gray-100 transition">
                                        Tutup
                                    </button>
                                    <button onclick="printStruk('{{ $trans->id }}')" class="px-4 py-2 bg-[#2251a5] rounded-lg text-white font-bold text-sm shadow-md hover:bg-blue-800 flex items-center gap-2 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                                        Cetak Struk
                                    </button>
                                </div>
                            </div>
                        </div>

                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    <p class="text-gray-500 font-bold">Tidak ada transaksi di tanggal ini.</p>
                                    <p class="text-sm text-gray-400 mt-1">Coba ubah filter tanggal di atas.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function printStruk(id) {
            var printContents = document.getElementById('strukContent-' + id).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = `
                <style>
                    @media print {
                        @page { margin: 0; size: auto; }
                        body {
                            font-family: 'Courier New', Courier, monospace;
                            color: #000;
                            background: #fff;
                            margin: 0;
                            padding: 10px;
                        }
                        .print-area {
                            width: 100%;
                            max-width: 320px; /* Ukuran pas buat printer kasir (80mm) */
                            margin: 0 auto; /* Supaya ke tengah */
                            padding: 10px;
                        }

                        /* Styling spesifik untuk elemen struk */
                        .text-center { text-align: center !important; }
                        .flex { display: flex !important; }
                        .justify-between { justify-content: space-between !important; }
                        .flex-1 { flex: 1 !important; }
                        .text-right { text-align: right !important; }

                        .font-bold { font-weight: bold !important; }
                        .font-black { font-weight: 900 !important; }

                        .border-b-2 { border-bottom: 2px dashed #000 !important; }
                        .mt-4 { margin-top: 15px !important; }
                        .mb-4 { margin-bottom: 15px !important; }

                        h2 { font-size: 22px !important; margin: 0 0 5px 0 !important; }
                        .text-xs { font-size: 12px !important; }
                        .text-sm { font-size: 14px !important; }
                        .text-lg { font-size: 18px !important; }
                        .text-\\[10px\\] { font-size: 10px !important; }
                    }
                </style>
                <div class="print-area">
                    ${printContents}
                </div>
            `;

            window.print();

            document.body.innerHTML = originalContents;
            window.location.reload();
        }
    </script>
@endsection
