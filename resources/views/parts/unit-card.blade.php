@php
    $cardBg = 'bg-gradient-to-br from-[#1e448e] to-[#153166]';
    $textColor = 'text-white';
    $borderColor = 'border-white/10';

    $statusDot = 'bg-emerald-400';
    $statusText = 'READY';

    $hasTransaction = $unit->activeTransaction ? true : false;

    if ($unit->status == 'main') {
        if ($hasTransaction && $unit->activeTransaction->status == 'paused') {
            $statusDot = 'bg-amber-400';
            $statusText = 'PAUSED';
        } else {
            $statusDot = 'bg-rose-500';
            $statusText = 'PLAYING';
        }
    } elseif ($unit->status == 'maintenance') {
        $statusDot = 'bg-orange-500';
        $statusText = 'MT';
    }
@endphp

<div class="relative {{ $cardBg }} rounded-2xl shadow-xl shadow-blue-900/10 border {{ $borderColor }} p-5 h-full flex flex-col justify-between group overflow-hidden transition-all hover:-translate-y-1 hover:shadow-2xl duration-300">

    <div class="absolute top-0 right-0 w-24 h-24 bg-white/5 rounded-full blur-xl -mr-10 -mt-10 pointer-events-none"></div>

    <div class="flex justify-between items-start mb-2 relative z-10">
        <div>
            <h4 class="text-xl font-extrabold text-white tracking-tight">{{ $unit->name }}</h4>
            <p class="text-[11px] text-blue-200 font-bold tracking-widest uppercase mt-0.5 opacity-80">{{ $unit->type }}</p>
        </div>

        <div class="flex items-center gap-3">
            <form id="deleteUnitForm-{{ $unit->id }}" action="{{ route('consoles.destroy', $unit->id) }}" method="POST">
                @csrf @method('DELETE')
                <button type="button" onclick="openConfirm('Yakin ingin menghapus unit TV ini secara permanen?', 'deleteUnitForm-{{ $unit->id }}')" class="text-white/30 hover:text-rose-400 transition-colors" title="Hapus Unit">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            </form>

            <div class="flex items-center gap-2 bg-black/20 px-2.5 py-1 rounded-md backdrop-blur-sm border border-white/5 shadow-inner">
                <span class="text-[10px] font-extrabold text-white tracking-wider">{{ $statusText }}</span>
                <span class="relative flex h-2.5 w-2.5">
                    @if ($statusText == 'PLAYING')
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full {{ $statusDot }} opacity-75"></span>
                    @endif
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 {{ $statusDot }}"></span>
                </span>
            </div>
        </div>
    </div>

    <div class="flex-1 flex flex-col items-center justify-center min-h-[140px] relative space-y-3 z-10">
        <svg class="w-16 h-16 text-white/90 drop-shadow-lg group-hover:scale-110 transition-transform duration-500" fill="currentColor" viewBox="0 0 24 24">
            <path d="M21 2H3c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h7v2H8v2h8v-2h-2v-2h7c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H3V4h18v12z" />
        </svg>

        @if ($unit->status == 'main' && $hasTransaction)
            <div class="flex flex-col items-center w-full animate-in fade-in zoom-in duration-300">
                <div class="bg-black/30 text-blue-100 text-[11px] font-bold px-3 py-0.5 rounded-full mb-2 border border-white/5 shadow-sm">
                    {{ Str::limit($unit->activeTransaction->customer_name, 15) }}
                </div>

                <div class="px-4 py-1.5 rounded-xl bg-white/10 border border-white/10 backdrop-blur-md w-full max-w-[160px] text-center shadow-inner">
                    @if ($unit->activeTransaction->status == 'paused')
                        <span class="text-xl font-black font-mono text-amber-400 tracking-widest">PAUSED</span>
                    @else
                        <span class="text-2xl font-black font-mono text-white countdown-timer drop-shadow-md" data-end="{{ $unit->activeTransaction->end_time }}">
                            --:--:--
                        </span>
                    @endif
                </div>
            </div>
        @elseif($unit->status == 'ready')
            <div class="bg-white/10 px-3 py-1 rounded-full border border-white/5">
                <p class="text-xs text-blue-100 font-bold tracking-wide">Siap Digunakan</p>
            </div>
        @else
            <div class="bg-orange-500/80 px-3 py-1 rounded-lg text-xs font-extrabold text-white shadow-sm border border-orange-400">MAINTENANCE</div>
        @endif
    </div>

    <div class="mt-4 pt-4 border-t border-white/10 relative z-10">
        @if ($unit->status == 'ready')
            <button onclick="openModal('{{ $unit->name }}', '{{ $unit->type }}', '{{ $unit->id }}')"
                class="w-full py-3 bg-white hover:bg-blue-50 text-brand-blue text-sm font-extrabold rounded-xl shadow-lg transition-all flex items-center justify-center gap-2 hover:shadow-white/20 hover:-translate-y-0.5">
                START GAME
            </button>
        @elseif($unit->status == 'main')
            <div class="grid grid-cols-2 gap-3">
                @if ($hasTransaction)
                    <form action="{{ route('booking.toggle', $unit->id) }}" method="POST">
                        @csrf
                        @if ($unit->activeTransaction->status == 'ongoing')
                            <button type="submit" class="w-full py-2.5 bg-amber-400 hover:bg-amber-300 text-amber-900 text-xs font-extrabold rounded-xl shadow-md transition-all flex items-center justify-center hover:-translate-y-0.5">
                                PAUSE
                            </button>
                        @else
                            <button type="submit" class="w-full py-2.5 bg-emerald-400 hover:bg-emerald-300 text-emerald-900 text-xs font-extrabold rounded-xl shadow-md transition-all flex items-center justify-center hover:-translate-y-0.5">
                                RESUME
                            </button>
                        @endif
                    </form>
                @endif
                <form id="stopUnitForm-{{ $unit->id }}" action="{{ route('booking.stop', $unit->id) }}" method="POST">
                    @csrf
                    <button type="button" onclick="openConfirm('Yakin ingin mereset waktu TV ini? Transaksi akan dianggap selesai.', 'stopUnitForm-{{ $unit->id }}')"
                        class="w-full py-2.5 bg-black/30 hover:bg-rose-500 text-white border border-white/10 text-xs font-extrabold rounded-xl shadow-md transition-all flex items-center justify-center hover:-translate-y-0.5">
                        STOP
                    </button>
                </form>
            </div>
        @endif
    </div>
</div>
