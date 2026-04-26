@extends('parts.layout')

@section('judul_halaman', 'Laporan & Riwayat')

@section('konten')

    <div class="mb-10 space-y-6">

        <form action="{{ route('reports.index') }}" method="GET" class="bg-white p-5 rounded-3xl shadow-sm border border-slate-200 flex flex-wrap items-end gap-5">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-xs font-extrabold text-slate-500 uppercase mb-2 tracking-wider">Dari Tanggal</label>
                <div class="relative">
                    <input type="date" name="start_date" value="{{ $startDate->format('Y-m-d') }}"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-brand-blue focus:border-brand-blue outline-none transition-all shadow-sm">
                </div>
            </div>
            <div class="flex-1 min-w-[200px]">
                <label class="block text-xs font-extrabold text-slate-500 uppercase mb-2 tracking-wider">Sampai Tanggal</label>
                <div class="relative">
                    <input type="date" name="end_date" value="{{ $endDate->format('Y-m-d') }}"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-brand-blue focus:border-brand-blue outline-none transition-all shadow-sm">
                </div>
            </div>
            <button type="submit" class="bg-brand-blue hover:bg-blue-800 text-white px-8 py-3 rounded-xl font-extrabold text-sm shadow-lg shadow-blue-900/20 hover:shadow-xl hover:-translate-y-0.5 transition-all flex items-center gap-2 h-[46px]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                Filter Data
            </button>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="relative bg-gradient-to-br from-emerald-400 to-emerald-600 text-white p-7 rounded-3xl shadow-lg shadow-emerald-900/20 border border-emerald-400/50 flex items-center justify-between overflow-hidden group">
                <div class="absolute right-0 top-0 w-32 h-32 bg-white/10 rounded-full blur-2xl -mr-10 -mt-10 transition-transform group-hover:scale-150 duration-700"></div>
                <div class="relative z-10">
                    <p class="text-emerald-100 text-xs font-extrabold uppercase tracking-widest mb-1">Total Pemasukan</p>
                    <h3 class="text-4xl font-black tracking-tight drop-shadow-sm">Rp {{ number_format($total_income, 0, ',', '.') }}</h3>
                </div>
                <div class="relative z-10 bg-white/20 p-4 rounded-2xl backdrop-blur-md border border-white/20 shadow-inner">
                    <svg class="w-8 h-8 text-white drop-shadow-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>

            <div class="relative bg-gradient-to-br from-[#1e448e] to-[#153166] text-white p-7 rounded-3xl shadow-lg shadow-blue-900/20 border border-white/10 flex items-center justify-between overflow-hidden group">
                <div class="absolute right-0 top-0 w-32 h-32 bg-white/5 rounded-full blur-2xl -mr-10 -mt-10 transition-transform group-hover:scale-150 duration-700"></div>
                <div class="relative z-10">
                    <p class="text-blue-200 text-xs font-extrabold uppercase tracking-widest mb-1">Total Transaksi</p>
                    <h3 class="text-4xl font-black tracking-tight drop-shadow-sm">{{ $total_transaksi }} <span class="text-lg font-bold text-blue-200/80 tracking-normal">Sesi</span></h3>
                </div>
                <div class="relative z-10 bg-white/10 p-4 rounded-2xl backdrop-blur-md border border-white/10 shadow-inner">
                    <svg class="w-8 h-8 text-white drop-shadow-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50/80 backdrop-blur-sm border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-5 font-extrabold text-xs text-slate-400 uppercase tracking-wider">Tanggal & Jam</th>
                        <th class="px-6 py-5 font-extrabold text-xs text-slate-400 uppercase tracking-wider">Nama Player</th>
                        <th class="px-6 py-5 font-extrabold text-xs text-slate-400 uppercase tracking-wider">Unit</th>
                        <th class="px-6 py-5 font-extrabold text-xs text-slate-400 uppercase tracking-wider">Durasi</th>
                        <th class="px-6 py-5 font-extrabold text-xs text-slate-400 uppercase tracking-wider text-right">Total Bayar</th>
                        <th class="px-6 py-5 font-extrabold text-xs text-slate-400 uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($transactions as $trans)
                        <tr class="hover:bg-blue-50/30 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="font-extrabold text-slate-800 tracking-tight">{{ $trans->created_at->format('d M Y') }}</div>
                                <div class="text-[11px] text-slate-400 font-bold mt-0.5">{{ $trans->created_at->format('H:i') }} WIB</div>
                            </td>
                            <td class="px-6 py-4 font-black text-slate-800 uppercase text-xs tracking-wide">{{ $trans->customer_name }}</td>

                            <td class="px-6 py-4">
                                @if($trans->console)
                                    <span class="inline-flex items-center gap-1.5 bg-slate-50 text-slate-600 border border-slate-200 px-3 py-1.5 rounded-lg text-xs font-bold shadow-sm">
                                        📺 {{ $trans->console->name }} <span class="opacity-50">({{ $trans->console->type }})</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 bg-rose-50 text-rose-500 border border-rose-200 px-3 py-1.5 rounded-lg text-xs font-bold shadow-sm">
                                        🗑️ Unit Dihapus
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if(isset($trans->is_begadang) && $trans->is_begadang)
                                    <span class="inline-flex items-center gap-1.5 bg-indigo-50 text-indigo-600 border border-indigo-200 px-3 py-1.5 rounded-lg text-xs font-black shadow-sm">
                                        🌙 Paket Begadang
                                    </span>
                                @else
                                    <span class="text-slate-600 font-extrabold">{{ floor($trans->duration_minutes / 60) }} Jam</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-black text-brand-blue text-right tracking-tight text-base">
                                Rp {{ number_format($trans->total_price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button onclick="document.getElementById('detailModal-{{ $trans->id }}').classList.remove('hidden')"
                                    class="bg-white border border-slate-200 text-slate-600 hover:text-brand-blue hover:border-blue-300 hover:bg-blue-50 px-4 py-2 rounded-xl font-extrabold text-xs shadow-sm transition-all flex items-center justify-center gap-1.5 mx-auto">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    Rincian
                                </button>
                            </td>
                        </tr>

                        <div id="detailModal-{{ $trans->id }}" class="fixed inset-0 bg-slate-900/60 hidden flex items-center justify-center z-50 backdrop-blur-sm p-4 transition-opacity">
                            <div class="bg-white w-full max-w-sm rounded-[2rem] shadow-2xl overflow-hidden flex flex-col max-h-[90vh] border border-slate-200">

                                <div class="bg-gradient-to-r from-[#1e448e] to-[#153166] px-6 py-5 flex justify-between items-center relative overflow-hidden flex-shrink-0">
                                    <div class="absolute right-0 top-0 w-24 h-24 bg-white/5 rounded-full blur-xl -mr-10 -mt-10"></div>
                                    <h3 class="font-extrabold text-white text-lg flex items-center gap-2 relative z-10 tracking-wide">
                                        <span>🧾</span> Rincian Transaksi
                                    </h3>
                                    <button onclick="document.getElementById('detailModal-{{ $trans->id }}').classList.add('hidden')" class="text-white/50 hover:text-white text-2xl font-bold leading-none relative z-10 transition-colors">&times;</button>
                                </div>

                                <div class="p-6 overflow-y-auto bg-slate-50 flex-1 flex justify-center items-start scrollbar-hide">
                                    <div id="strukContent-{{ $trans->id }}" class="bg-white text-slate-900 font-mono text-sm relative w-full max-w-[320px] p-5 border border-dashed border-slate-300 rounded-sm shadow-sm">

                                        <div class="text-center mb-5 struk-header">
                                            <h2 class="font-black text-2xl tracking-tighter leading-none mb-1 text-center">RIZKI RENTAL PS</h2>
                                            <p class="text-[11px] text-slate-500 text-center font-bold tracking-widest uppercase">Rental PS Terbaik Tangerang</p>
                                            <div class="border-b-2 border-dashed border-slate-300 mt-4 mb-3"></div>
                                        </div>

                                        <div class="space-y-1.5 mb-4 text-[11px] font-bold text-slate-600 struk-info uppercase tracking-wide">
                                            <div class="flex justify-between">
                                                <span>TRX ID:</span>
                                                <span class="text-slate-900">#TRX-{{ str_pad($trans->id, 5, '0', STR_PAD_LEFT) }}</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span>Tanggal:</span>
                                                <span class="text-slate-900">{{ $trans->created_at->format('d/m/y H:i') }}</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span>Kasir:</span>
                                                <span class="text-slate-900">Admin</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span>Player:</span>
                                                <span class="text-slate-900">{{ $trans->customer_name }}</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span>Console:</span>
                                                <span class="text-slate-900">
                                                    @if($trans->console)
                                                        {{ $trans->console->name }} ({{ $trans->console->type }})
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                            </div>
                                        </div>

                                        <div class="border-b-2 border-dashed border-slate-300 mb-4 mt-3"></div>

                                        <div class="space-y-3 text-xs struk-items">
                                            <div class="flex justify-between items-start">
                                                <div class="flex-1 pr-2">
                                                    @if(isset($trans->is_begadang) && $trans->is_begadang)
                                                        <div class="font-black text-slate-900">PAKET BEGADANG</div>
                                                        <div class="text-[10px] text-slate-500 font-bold mt-0.5">S/D 06:00 WIB</div>
                                                    @else
                                                        <div class="font-black text-slate-900">SEWA RENTAL</div>
                                                        <div class="text-[10px] text-slate-500 font-bold mt-0.5">{{ floor($trans->duration_minutes / 60) }} JAM</div>
                                                    @endif
                                                </div>
                                                <div class="font-black text-right text-slate-900">
                                                    @php
                                                        $fnbTotal = $trans->details->sum('subtotal');
                                                        $rentalPrice = $trans->total_price - $fnbTotal;
                                                    @endphp
                                                    {{ number_format($rentalPrice, 0, ',', '.') }}
                                                </div>
                                            </div>

                                            @foreach($trans->details as $detail)
                                                <div class="flex justify-between items-start">
                                                    <div class="flex-1 pr-2">
                                                        <div class="font-black text-slate-900 uppercase">{{ $detail->product ? $detail->product->name : 'ITEM DIHAPUS' }}</div>
                                                        <div class="text-[10px] text-slate-500 font-bold mt-0.5">{{ $detail->quantity }}x @ {{ number_format($detail->price, 0, ',', '.') }}</div>
                                                    </div>
                                                    <div class="font-black text-right mt-3 text-slate-900">
                                                        {{ number_format($detail->subtotal, 0, ',', '.') }}
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="border-b-2 border-dashed border-slate-300 mb-4 mt-5"></div>

                                        <div class="flex justify-between items-center text-sm mb-6 struk-total">
                                            <span class="font-black text-slate-900">TOTAL BAYAR</span>
                                            <span class="font-black text-lg text-slate-900">Rp {{ number_format($trans->total_price, 0, ',', '.') }}</span>
                                        </div>

                                        <div class="text-center text-[10px] text-slate-500 space-y-1 font-bold struk-footer tracking-widest">
                                            <p>TERIMA KASIH TELAH BERMAIN</p>
                                            <p>DI RIZKI RENTAL PS</p>
                                            <p class="mt-3 text-xs tracking-normal">-- LUNAS --</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-white px-6 py-4 border-t border-slate-100 flex justify-end gap-3 flex-shrink-0">
                                    <button onclick="document.getElementById('detailModal-{{ $trans->id }}').classList.add('hidden')" class="px-5 py-2.5 bg-slate-100 rounded-xl text-slate-600 font-extrabold text-sm hover:bg-slate-200 transition-colors">
                                        Tutup
                                    </button>
                                    <button onclick="printStruk('{{ $trans->id }}')" class="px-5 py-2.5 bg-brand-blue rounded-xl text-white font-extrabold text-sm shadow-md shadow-blue-900/20 hover:bg-blue-800 flex items-center gap-2 transition-all hover:-translate-y-0.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                                        Cetak Struk
                                    </button>
                                </div>
                            </div>
                        </div>

                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 text-slate-300 mb-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    <p class="text-slate-400 font-extrabold text-sm">Tidak ada transaksi di tanggal ini.</p>
                                    <p class="text-xs text-slate-400 mt-1 font-semibold">Coba ubah filter tanggal di atas.</p>
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
                            max-width: 320px; /* Lebar kertas kasir thermal */
                            margin: 0 auto;
                            padding: 10px;
                        }

                        /* Override Tailwind classes buat print */
                        .text-center { text-align: center !important; }
                        .flex { display: flex !important; }
                        .justify-between { justify-content: space-between !important; }
                        .items-start { align-items: flex-start !important; }
                        .flex-1 { flex: 1 !important; }
                        .text-right { text-align: right !important; }

                        .font-bold { font-weight: bold !important; }
                        .font-black { font-weight: 900 !important; }
                        .uppercase { text-transform: uppercase !important; }

                        .border-b-2 { border-bottom: 2px dashed #000 !important; }
                        .mt-3 { margin-top: 10px !important; }
                        .mt-4 { margin-top: 15px !important; }
                        .mt-5 { margin-top: 20px !important; }
                        .mb-3 { margin-bottom: 10px !important; }
                        .mb-4 { margin-bottom: 15px !important; }
                        .mb-5 { margin-bottom: 20px !important; }
                        .mb-6 { margin-bottom: 25px !important; }
                        .pr-2 { padding-right: 8px !important; }

                        h2 { font-size: 22px !important; margin: 0 0 5px 0 !important; }
                        .text-xs { font-size: 12px !important; }
                        .text-sm { font-size: 14px !important; }
                        .text-lg { font-size: 18px !important; }
                        .text-\\[11px\\] { font-size: 11px !important; }
                        .text-\\[10px\\] { font-size: 10px !important; }
                        .tracking-widest { letter-spacing: 0.1em !important; }

                        /* Reset warna teks jadi hitam semua pas diprint */
                        .text-slate-900, .text-slate-600, .text-slate-500 { color: #000 !important; }
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
