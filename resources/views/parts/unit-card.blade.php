@php
    // --- SETUP WARNA ---
    // Background Card SELALU BIRU sesuai request
    $cardBg = 'bg-[#2251a5]';
    $textColor = 'text-white';
    $borderColor = 'border-blue-400/30';

    // Status Indicator Colors (Tetep Merah/Hijau/Kuning)
    $statusDot = 'bg-green-400';
    $statusText = 'READY';

    $hasTransaction = $unit->activeTransaction ? true : false;

    if ($unit->status == 'main') {
        if ($hasTransaction && $unit->activeTransaction->status == 'paused') {
            $statusDot = 'bg-yellow-400'; // Kuning
            $statusText = 'PAUSED';
        } else {
            $statusDot = 'bg-red-500'; // Merah
            $statusText = 'PLAYING';
        }
    } elseif ($unit->status == 'maintenance') {
        $statusDot = 'bg-orange-500';
        $statusText = 'MT';
    }
@endphp

<div
    class="relative {{ $cardBg }} rounded-xl shadow-lg border {{ $borderColor }} p-4 h-full flex flex-col justify-between group overflow-hidden transition hover:scale-[1.02] duration-300">

    <div class="flex justify-between items-start mb-2 relative z-10">
        <div>
            <h4 class="text-xl font-black text-white italic tracking-wider">{{ $unit->name }}</h4>
            <p class="text-[10px] text-blue-200 font-mono">{{ $unit->type }}</p>
        </div>

        <div class="flex items-center gap-3">
            <form id="deleteUnitForm-{{ $unit->id }}" action="{{ route('consoles.destroy', $unit->id) }}"
                method="POST">
                @csrf @method('DELETE')

                <button type="button"
                    onclick="openConfirm('Yakin ingin menghapus unit TV ini secara permanen?', 'deleteUnitForm-{{ $unit->id }}')"
                    class="text-white/50 hover:text-white transition-all" title="Hapus Unit">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                        </path>
                    </svg>
                </button>
            </form>

            <div
                class="flex items-center gap-2 bg-black/20 px-2 py-1 rounded-full backdrop-blur-sm border border-white/10">
                <span class="text-[10px] font-bold text-white tracking-wider">{{ $statusText }}</span>
                <span class="relative flex h-2.5 w-2.5">
                    @if ($statusText == 'PLAYING')
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full {{ $statusDot }} opacity-75"></span>
                    @endif
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 {{ $statusDot }}"></span>
                </span>
            </div>
        </div>
    </div>

    <div class="flex-1 flex flex-col items-center justify-center min-h-[140px] relative space-y-3">

        <svg class="w-16 h-16 text-white/90 drop-shadow-md" fill="currentColor" viewBox="0 0 24 24">
            <path
                d="M21 2H3c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h7v2H8v2h8v-2h-2v-2h7c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H3V4h18v12z" />
        </svg>

        @if ($unit->status == 'main' && $hasTransaction)
            <div class="flex flex-col items-center w-full animate-in fade-in zoom-in duration-300">
                <div class="bg-black/20 text-blue-100 text-[10px] px-2 rounded mb-1">
                    {{ Str::limit($unit->activeTransaction->customer_name, 15) }}
                </div>

                <div
                    class="px-4 py-1 rounded-lg bg-white/10 border border-white/20 backdrop-blur-md w-full max-w-[160px] text-center shadow-inner">
                    @if ($unit->activeTransaction->status == 'paused')
                        <span class="text-xl font-black font-mono text-yellow-300 tracking-widest">PAUSED</span>
                    @else
                        <span class="text-2xl font-black font-mono text-white countdown-timer drop-shadow-sm"
                            data-end="{{ $unit->activeTransaction->end_time }}">
                            --:--:--
                        </span>
                    @endif
                </div>
            </div>
        @elseif($unit->status == 'ready')
            <p class="text-xs text-blue-200/80 font-medium">Siap Digunakan</p>
        @else
            <div class="bg-orange-500/80 px-2 py-1 rounded text-xs font-bold text-white">MAINTENANCE</div>
        @endif

    </div>

    <div class="mt-2 pt-3 border-t border-white/10 relative z-10">
        @if ($unit->status == 'ready')
            <button onclick="openModal('{{ $unit->name }}', '{{ $unit->type }}', '{{ $unit->id }}')"
                class="w-full py-3 bg-white hover:bg-blue-50 text-[#2251a5] text-sm font-bold rounded-xl shadow-lg transition-all flex items-center justify-center gap-2 group">
                START GAME
            </button>
        @elseif($unit->status == 'main')
            <div class="grid grid-cols-2 gap-2">

                @if ($hasTransaction)
                    <form action="{{ route('booking.toggle', $unit->id) }}" method="POST">
                        @csrf
                        @if ($unit->activeTransaction->status == 'ongoing')
                            <button type="submit"
                                class="w-full py-2.5 bg-yellow-400 hover:bg-yellow-300 text-yellow-900 text-xs font-black rounded-lg shadow transition flex flex-col items-center justify-center">
                                PAUSE
                            </button>
                        @else
                            <button type="submit"
                                class="w-full py-2.5 bg-green-400 hover:bg-green-300 text-green-900 text-xs font-black rounded-lg shadow transition flex flex-col items-center justify-center">
                                RESUME
                            </button>
                        @endif
                    </form>
                @endif

                <form id="stopUnitForm-{{ $unit->id }}" action="{{ route('booking.stop', $unit->id) }}"
                    method="POST">
                    @csrf
                    <button type="button"
                        onclick="openConfirm('Yakin ingin mereset waktu TV ini? Transaksi akan dianggap selesai.', 'stopUnitForm-{{ $unit->id }}')"
                        class="w-full py-2.5 bg-black/40 hover:bg-red-600 text-white text-xs font-bold rounded-lg shadow transition flex flex-col items-center justify-center">
                        STOP
                    </button>
                </form>
            </div>
        @endif
    </div>
</div>
