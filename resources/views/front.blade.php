<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rizki Rental - Ketersediaan Unit</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-900">

    <nav class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-[1400px] mx-auto flex items-center justify-between px-4 py-3">
            <a class="flex items-center gap-3 group" href="#">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-10 transition-transform duration-300 group-hover:scale-110">
                <span class="hidden sm:block text-xl font-black text-[#2251a5] tracking-wide">RIZKI RENTAL</span>
            </a>

            <div class="flex items-center space-x-6 font-bold text-sm">
                @if(auth()->check() && auth()->user()->role === 'admin')
                    <div class="relative">
                        <select onchange="window.location.href=this.value" class="bg-blue-50 text-[#2251a5] border border-blue-200 rounded-lg py-2 px-3 focus:ring-2 focus:ring-[#2251a5] focus:outline-none cursor-pointer shadow-sm transition hover:bg-blue-100">
                            <option value="{{ route('front') }}" selected>🌐 Tampilan User Biasa</option>
                            <option value="{{ route('home') }}">🖥️ Tampilan Manajemen</option>
                        </select>
                    </div>
                @endif
                <a class="text-gray-500 hover:text-[#2251a5] transition-colors" href="#">About</a>

                @if(auth()->check())
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="text-red-600 bg-red-50 hover:bg-red-100 border border-red-200 px-4 py-2 rounded-lg transition shadow-sm">Logout</button>
                    </form>
                @endif
            </div>
        </div>
    </nav>

    <section class="relative h-[25vh] md:h-[35vh] overflow-hidden bg-[#2251a5]">
        <svg class="absolute -right-10 -bottom-20 w-96 h-96 text-white/10 rotate-12" fill="currentColor" viewBox="0 0 24 24"><path d="M21 6H3c-1.1 0-2 .9-2 2v8c0 1.1.9 2 2 2h18c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-10 7H4.41c.62-1.29 1.61-2.31 2.85-2.97V7h2.48v3.03c1.24.66 2.23 1.68 2.85 2.97H11v-3zM8 11.5c0-.83-.67-1.5-1.5-1.5S5 10.67 5 11.5s.67 1.5 1.5 1.5 1.5-.67 1.5-1.5zm11 1.5h-2.41c-.62 1.29-1.61 2.31-2.85 2.97V17h-2.48v-3.03c-1.24-.66-2.23-1.68-2.85-2.97H19v3zm-1.5-1.5c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5.67 1.5 1.5 1.5 1.5-.67 1.5-1.5z"/></svg>
        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
        <div class="relative h-full flex flex-col justify-center items-start p-6 max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl md:text-5xl font-black text-white mb-2 tracking-tight">Rizki Rental <span class="text-blue-300">PlayStation</span></h1>
            <p class="text-blue-100 text-sm md:text-base max-w-xl font-medium">Pantau ketersediaan unit PlayStation secara real-time. Siap menemani mabar dan push rank kamu.</p>
        </div>
    </section>

    <main class="relative max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <div class="flex flex-col md:flex-row items-center justify-between mb-8 gap-4">
            <div>
                <h2 class="text-2xl md:text-3xl font-black text-gray-800">Status <span class="text-[#2251a5]">Unit</span></h2>
                <p class="text-gray-500 text-sm font-bold">Monitor ketersediaan TV/Console secara real-time</p>
            </div>
        </div>

        @php
            // Kelompokkin data console berdasarkan 'type' (Contoh: PS3, PS4) biar persis kayak Spade (Reguler, Arena)
            $groupedConsoles = $consoles->groupBy('type');
        @endphp

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
            <div class="bg-white rounded-xl p-4 text-center border border-gray-200 shadow-sm col-span-2 md:col-span-1">
                <div class="text-3xl font-black text-[#2251a5]">{{ $consoles->where('status', 'main')->count() }}<span class="text-gray-400 font-bold text-lg">/{{ $consoles->count() }}</span></div>
                <div class="text-xs font-bold text-gray-500 uppercase mt-1">Total Sedang Main</div>
            </div>

            @foreach($groupedConsoles as $type => $typeConsoles)
                <div class="bg-white rounded-xl p-4 text-center border border-gray-200 shadow-sm">
                    <div class="text-3xl font-black text-blue-500">{{ $typeConsoles->where('status', 'main')->count() }}<span class="text-gray-400 font-bold text-lg">/{{ $typeConsoles->count() }}</span></div>
                    <div class="text-xs font-bold text-gray-500 uppercase mt-1">Unit {{ $type }}</div>
                </div>
            @endforeach
        </div>

        <div class="space-y-8">
            @foreach($groupedConsoles as $type => $typeConsoles)
                <div class="bg-white rounded-2xl p-4 md:p-6 border border-gray-200 shadow-sm">
                    <div class="text-sm font-black mb-4 text-[#2251a5] border-b border-gray-100 pb-2 tracking-widest uppercase">{{ $type }}</div>

                    <div class="grid grid-cols-4 sm:grid-cols-5 md:grid-cols-6 lg:grid-cols-8 xl:grid-cols-10 gap-2 sm:gap-3">

                        @foreach($typeConsoles as $console)
                            @php $activeTx = $console->activeTransaction; @endphp

                            @if($console->status == 'ready')
                                <div class="block rounded-lg p-2 md:p-3 border transition-all duration-300 min-w-0 bg-white border-blue-200 shadow-sm hover:border-blue-500 hover:shadow-md cursor-pointer group">
                                    <div class="text-center min-w-0">
                                        <div class="text-[10px] sm:text-xs font-bold break-words leading-tight text-[#2251a5] group-hover:text-blue-600">{{ $console->name }}</div>
                                        <div class="flex items-center justify-center gap-1 mt-1.5">
                                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500 flex-shrink-0"></span>
                                            <span class="text-[8px] sm:text-[9px] text-blue-600 font-black tracking-widest uppercase">Ready</span>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="block rounded-lg p-2 md:p-3 border transition-all duration-300 min-w-0 bg-red-50 border-red-200 shadow-sm">
                                    <div class="text-center min-w-0">
                                        <div class="text-[10px] sm:text-xs font-bold break-words leading-tight text-red-700">{{ $console->name }}</div>
                                        <div class="flex items-center justify-center gap-1 mt-1.5 bg-white py-0.5 rounded border border-red-100 shadow-inner">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse flex-shrink-0"></span>
                                            <span class="text-[8px] sm:text-[10px] text-red-600 font-mono font-bold tabular-nums">
                                                {{ $activeTx ? \Carbon\Carbon::parse($activeTx->created_at)->format('H:i') : 'IN USE' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        @endforeach

                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8 pt-6 border-t border-gray-200">
            <div class="flex flex-wrap items-center justify-center gap-4 sm:gap-6">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span>
                    <span class="text-xs font-black text-gray-500 uppercase tracking-wider">Tersedia (Ready)</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-red-500 animate-pulse"></span>
                    <span class="text-xs font-black text-gray-500 uppercase tracking-wider">Sedang Main (In Use)</span>
                </div>
            </div>
        </div>

    </main>
</body>
</html>
