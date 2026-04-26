<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rizki Rental - Rental PS Terbaik</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        html {
            scroll-behavior: smooth;
            scroll-padding-top: 80px;
        }
        body {
            font-family: 'Inter', sans-serif;
        }

        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.5, 0, 0, 1);
        }
        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased selection:bg-[#1e448e] selection:text-white">

    <nav class="bg-white/90 backdrop-blur-md border-b border-slate-200 shadow-sm sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-6xl mx-auto flex items-center justify-between px-6 py-3.5">
            <a class="flex items-center gap-3 group" href="#">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Rizki Rental" class="h-9 w-9 transition-transform duration-300 group-hover:scale-110 drop-shadow-sm">
                <span class="text-lg font-black text-[#1e448e] tracking-tight">RIZKI RENTAL</span>
            </a>

            <div class="hidden md:flex items-center space-x-6 font-bold text-sm">
                <a class="text-[#1e448e] hover:text-slate-500 transition-colors" href="#status">Status Unit</a>
                <a class="text-[#1e448e] hover:text-slate-500 transition-colors" href="#harga">Pricelist</a>
                <a class="text-[#1e448e] hover:text-slate-500 transition-colors" href="#fasilitas">Fasilitas</a>
                <a class="text-[#1e448e] hover:text-slate-500 transition-colors" href="#lokasi">Lokasi</a>

                <div class="h-5 w-px bg-slate-200 mx-1"></div>

                @if(auth()->check())
                    @if(auth()->user()->role === 'admin')
                        <div class="relative" id="navModeDropdownWrapper">
                            <button type="button" onclick="toggleNavMode()" class="flex items-center gap-2 bg-slate-100 text-[#1e448e] border border-slate-200 rounded-lg py-1.5 px-3 focus:outline-none focus:ring-2 focus:ring-[#1e448e] font-bold hover:bg-slate-200 transition-all shadow-sm">
                                <span class="text-xs">Mode User</span>
                                <svg class="w-4 h-4 text-slate-500 transition-transform duration-200" id="navModeIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>

                            <div id="navModeMenu" class="absolute right-0 top-[45px] w-48 bg-white rounded-xl shadow-lg border border-slate-100 opacity-0 invisible scale-95 origin-top-right transition-all duration-200 z-50 overflow-hidden">
                                <div class="p-1.5 flex flex-col gap-0.5">
                                    <a href="{{ route('front') }}" class="w-full text-left px-3 py-2 text-sm font-bold text-[#1e448e] bg-blue-50 rounded-lg transition-colors flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Mode User
                                    </a>
                                    <a href="{{ route('home') }}" class="w-full text-left px-3 py-2 text-sm font-bold text-slate-600 hover:bg-slate-50 hover:text-slate-900 rounded-lg transition-colors flex items-center gap-2 group">
                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-300 group-hover:bg-slate-500"></span> Manajemen Admin
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="text-rose-500 hover:text-white border border-rose-200 hover:border-rose-500 bg-rose-50 hover:bg-rose-500 px-4 py-1.5 rounded-lg font-extrabold transition-all duration-300 shadow-sm text-sm flex items-center gap-2">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="bg-gradient-to-r from-[#1e448e] to-[#153166] text-white px-6 py-2 rounded-lg font-extrabold hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                        Login
                    </a>
                @endif
            </div>
        </div>
    </nav>

    <section class="relative bg-cover bg-center overflow-hidden reveal" style="background-image: url('https://images.unsplash.com/photo-1593305841991-05c297ba4575?q=80&w=2057&auto=format&fit=crop');">

        <div class="absolute inset-0 bg-gradient-to-br from-[#1a3d7c]/90 to-[#2251a5]/80"></div>

        <div class="relative max-w-4xl mx-auto px-6 pt-24 pb-36 md:pt-32 md:pb-48 flex flex-col items-center text-center z-10">
            <span class="bg-white/20 border border-white/30 backdrop-blur-sm text-blue-50 px-4 py-1.5 rounded-full text-[10px] font-black tracking-widest uppercase mb-5 shadow-sm">
                Tempat Rental PS Terbaik di Tangerang!
            </span>
            <h1 class="text-4xl md:text-5xl font-black text-white mb-5 tracking-tight leading-tight drop-shadow-xl">
                Rasakan Pengalaman <br> <span class="text-blue-300">Gaming</span> Tanpa Batas.
            </h1>
            <p class="text-blue-50/90 text-base md:text-lg max-w-2xl font-semibold mb-8 drop-shadow">
                Sewa PlayStation dengan mudah, cepat, dan tanpa antri. Semua bisa kamu cek langsung secara real-time.
            </p>
            <a href="#status" class="bg-white text-[#1e448e] font-extrabold px-8 py-3.5 rounded-xl shadow-[0_10px_20px_rgba(0,0,0,0.15)] hover:bg-blue-50 hover:shadow-[0_10px_30px_rgba(0,0,0,0.25)] hover:-translate-y-1 transition-all duration-300 text-sm flex items-center gap-2">
                Cek Ketersediaan Unit
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
            </a>
        </div>

        <svg class="absolute bottom-0 w-full text-slate-50 translate-y-1 z-10 pointer-events-none" viewBox="0 0 1440 100" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,50 C320,150 420,-50 1440,50 L1440,100 L0,100 Z"></path>
        </svg>
    </section>

    <section id="status" class="py-16 px-6 reveal">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12 flex flex-col items-center">
                <h2 class="text-3xl md:text-4xl font-black text-slate-800 tracking-tight">Status <span class="text-[#1e448e]">Unit Real-time</span></h2>
                <p class="text-slate-500 mt-3 text-sm font-bold max-w-lg">Data di bawah ini update otomatis sesuai sistem kasir kami.</p>

                @auth
                    <a href="{{ route('user.topup') }}" class="mt-6 inline-flex items-center gap-2 bg-gradient-to-r from-[#1e448e] to-[#153166] text-white font-extrabold px-6 py-3 rounded-xl shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all text-sm border border-[#1e448e]/50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        Isi Saldo Waktu Disini
                    </a>
                @endauth
            </div>

            @php
                $groupedConsoles = isset($consoles) ? $consoles->groupBy('type') : collect([]);
            @endphp

            <div class="space-y-8">
                @forelse($groupedConsoles as $type => $typeConsoles)
                    <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm hover:shadow-md transition-shadow duration-300">
                        <div class="flex justify-between items-center mb-6 pb-4 border-b border-slate-100">
                            <h3 class="text-xl font-black text-slate-800 flex items-center gap-2.5">
                                <span class="w-1.5 h-6 bg-gradient-to-b from-[#1e448e] to-[#153166] rounded-full"></span>
                                {{ $type }}
                            </h3>
                            <span class="bg-slate-100 text-slate-600 text-xs font-extrabold px-3 py-1 rounded-lg border border-slate-200">Total {{ $typeConsoles->count() }} Unit</span>
                        </div>

                        <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-4">
                            @foreach($typeConsoles as $console)
                                @if($console->status == 'ready')
                                    @auth
                                        <div onclick="bukaModalBooking('{{ $console->id }}', '{{ $console->name }}')" class="rounded-xl border-2 border-slate-100 bg-white p-3 text-center hover:border-[#1e448e] hover:shadow-sm transition-all cursor-pointer group">
                                            <div class="text-xs font-extrabold text-slate-700 mb-2 group-hover:text-[#1e448e] transition-colors">{{ $console->name }}</div>
                                            <div class="flex items-center justify-center gap-1.5 bg-emerald-50 py-1 rounded border border-emerald-100">
                                                <div class="w-1.5 h-1.5 rounded-full bg-emerald-500"></div>
                                                <span class="text-[9px] text-emerald-700 font-black tracking-widest uppercase">Ready</span>
                                            </div>
                                        </div>
                                    @else
                                        <div onclick="tampilToastBelumLogin()" class="rounded-xl border-2 border-slate-100 bg-white p-3 text-center hover:border-rose-400 hover:shadow-sm transition-all cursor-pointer group">
                                            <div class="text-xs font-extrabold text-slate-700 mb-2 group-hover:text-rose-500 transition-colors">{{ $console->name }}</div>
                                            <div class="flex items-center justify-center gap-1.5 bg-emerald-50 py-1 rounded border border-emerald-100">
                                                <div class="w-1.5 h-1.5 rounded-full bg-emerald-500"></div>
                                                <span class="text-[9px] text-emerald-700 font-black tracking-widest uppercase">Ready</span>
                                            </div>
                                        </div>
                                    @endauth
                                @else
                                    <div class="rounded-xl border-2 border-rose-100 bg-rose-50/50 p-3 text-center relative overflow-hidden">
                                        <div class="text-xs font-extrabold text-slate-700 mb-1">{{ $console->name }}</div>

                                        @php
                                            $activeTx = $console->activeTransaction;
                                        @endphp

                                        @if($activeTx && $activeTx->end_time)
                                            <div class="text-sm font-black text-rose-600 mb-1 tracking-widest countdown-timer drop-shadow-sm"
                                                 data-endtime="{{ \Carbon\Carbon::parse($activeTx->end_time)->toIso8601String() }}">
                                                --:--:--
                                            </div>
                                        @else
                                            <div class="text-[10px] font-bold text-slate-400 mb-2">Sedang Main</div>
                                        @endif

                                        <div class="flex items-center justify-center gap-1.5 bg-rose-100/80 py-1 rounded border border-rose-200 mt-1">
                                            <div class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></div>
                                            <span class="text-[9px] text-rose-700 font-black tracking-widest uppercase">Dipakai</span>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div class="text-center bg-white p-8 rounded-3xl shadow-sm border border-slate-200 flex flex-col items-center">
                        <svg class="w-12 h-12 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                        <span class="text-slate-500 font-extrabold text-sm">Data unit belum tersedia.</span>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="harga" class="py-16 bg-white px-6 border-t border-slate-100 reveal">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-12 flex flex-col items-center">
                <h2 class="text-3xl md:text-4xl font-black text-slate-800 tracking-tight">Paket <span class="text-[#1e448e]">Harga Sewa</span></h2>
                <p class="text-slate-500 mt-3 text-sm font-bold">Harga jujur, kantong aman, mabar jalan terus.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
                <div class="bg-slate-50 border border-slate-200 rounded-3xl p-6 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                    <div class="text-center mb-6 border-b border-slate-200 pb-4">
                        <h3 class="text-xl font-black text-slate-800 mb-1 tracking-tight">PLAYSTATION 3</h3>
                        <p class="text-slate-500 font-semibold text-xs">Cocok buat santai & nostalgia</p>
                    </div>
                    <ul class="space-y-4 mb-4 text-sm">
                        <li class="flex justify-between items-center"><span class="font-bold text-slate-500">1 Jam</span><span class="font-black text-slate-800">Rp 5.000</span></li>
                        <li class="flex justify-between items-center"><span class="font-bold text-slate-500">2 Jam</span><span class="font-black text-slate-800">Rp 10.000</span></li>
                        <li class="flex justify-between items-center"><span class="font-bold text-slate-500">3 Jam</span><span class="font-black text-slate-800">Rp 15.000</span></li>
                        <li class="flex justify-between items-center bg-white p-3 rounded-xl mt-4 border border-slate-200 shadow-sm">
                            <span class="font-extrabold text-[#1e448e]">Paket Malam</span>
                            <span class="font-black text-[#1e448e] text-base">Rp 40.000</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-gradient-to-b from-[#1e448e] to-[#153166] rounded-[2rem] p-6 shadow-xl transform md:scale-105 relative border border-blue-400/30 z-10">
                    <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-gradient-to-r from-amber-400 to-amber-500 text-amber-950 font-black text-[10px] px-4 py-1.5 rounded-full uppercase tracking-widest shadow-md border border-amber-300 flex items-center gap-1.5">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-1.245-1.134-1.745a2.994 2.994 0 01-.067-.668c.002-.33.118-.636.27-.92a3 3 0 00.375-1.164zm-5.006 7.027c.05.03.111.063.18.098.243.125.684.305 1.166.305.517 0 .972-.187 1.258-.337l.006-.003c.123-.065.253-.138.385-.224a13.974 13.974 0 011.096-2.923A5.002 5.002 0 0115 11a5 5 0 11-10 0 4.975 4.975 0 012.389-4.42c.07.195.14.394.212.593.268.74.567 1.488.788 2.407z" clip-rule="evenodd"/></svg>
                        Paling Laris
                    </div>
                    <div class="text-center mb-6 border-b border-white/10 pb-4 mt-2">
                        <h3 class="text-2xl font-black text-white mb-1 tracking-tight">PLAYSTATION 4</h3>
                        <p class="text-blue-200 font-semibold text-xs">Grafis mantap, game lengkap</p>
                    </div>
                    <ul class="space-y-4 mb-2 text-sm">
                        <li class="flex justify-between items-center"><span class="font-bold text-blue-200">1 Jam</span><span class="font-black text-white text-base">Rp 10.000</span></li>
                        <li class="flex justify-between items-center"><span class="font-bold text-blue-200">2 Jam</span><span class="font-black text-white text-base">Rp 20.000</span></li>
                        <li class="flex justify-between items-center"><span class="font-bold text-blue-200">3 Jam</span><span class="font-black text-white text-base">Rp 28.000</span></li>
                        <li class="flex justify-between items-center bg-white/10 backdrop-blur-md p-3 rounded-xl mt-4 border border-white/20">
                            <span class="font-extrabold text-amber-300">Paket Malam</span>
                            <span class="font-black text-amber-300 text-lg">Rp 80.000</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-slate-50 border border-slate-200 rounded-3xl p-6 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                    <div class="text-center mb-6 border-b border-slate-200 pb-4">
                        <h3 class="text-xl font-black text-slate-800 mb-1 tracking-tight">PLAYSTATION 5</h3>
                        <p class="text-slate-500 font-semibold text-xs">Pengalaman next-gen sejati</p>
                    </div>
                    <ul class="space-y-4 mb-4 text-sm">
                        <li class="flex justify-between items-center"><span class="font-bold text-slate-500">1 Jam</span><span class="font-black text-slate-800">Rp 20.000</span></li>
                        <li class="flex justify-between items-center"><span class="font-bold text-slate-500">2 Jam</span><span class="font-black text-slate-800">Rp 40.000</span></li>
                        <li class="flex justify-between items-center"><span class="font-bold text-slate-500">3 Jam</span><span class="font-black text-slate-800">Rp 55.000</span></li>
                        <li class="flex justify-between items-center bg-white p-3 rounded-xl mt-4 border border-slate-200 shadow-sm">
                            <span class="font-extrabold text-[#1e448e]">Paket Malam</span>
                            <span class="font-black text-[#1e448e] text-base">Rp 150.000</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section id="fasilitas" class="py-16 bg-slate-50 px-6 border-t border-slate-200 reveal">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-black text-slate-800 tracking-tight">Fasilitas <span class="text-[#1e448e]">Kenyamanan</span></h2>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm text-center group hover:-translate-y-1 hover:shadow-md transition-all duration-300">
                    <div class="w-14 h-14 bg-blue-50 text-[#1e448e] rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-[#1e448e] group-hover:text-white transition-colors duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v18m-9-9h18M5.293 5.293l13.414 13.414M5.293 18.707L18.707 5.293"></path></svg>
                    </div>
                    <h4 class="font-black text-slate-800 mb-1 text-sm">Ruangan Ber-AC</h4>
                    <p class="text-xs font-semibold text-slate-500">Dingin maksimal, anti gerah.</p>
                </div>
                <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm text-center group hover:-translate-y-1 hover:shadow-md transition-all duration-300">
                    <div class="w-14 h-14 bg-blue-50 text-[#1e448e] rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-[#1e448e] group-hover:text-white transition-colors duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v10z"></path></svg>
                    </div>
                    <h4 class="font-black text-slate-800 mb-1 text-sm">Makan & Minum</h4>
                    <p class="text-xs font-semibold text-slate-500">Tersedia snack, mie, & minuman.</p>
                </div>
                <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm text-center group hover:-translate-y-1 hover:shadow-md transition-all duration-300">
                    <div class="w-14 h-14 bg-blue-50 text-[#1e448e] rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-[#1e448e] group-hover:text-white transition-colors duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"></path></svg>
                    </div>
                    <h4 class="font-black text-slate-800 mb-1 text-sm">WiFi Gratis</h4>
                    <p class="text-xs font-semibold text-slate-500">Koneksi stabil buat main online.</p>
                </div>
                <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm text-center group hover:-translate-y-1 hover:shadow-md transition-all duration-300">
                    <div class="w-14 h-14 bg-blue-50 text-[#1e448e] rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-[#1e448e] group-hover:text-white transition-colors duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21h18M5 21V5a2 2 0 012-2h10a2 2 0 012 2v16m-7-5h4"></path></svg>
                    </div>
                    <h4 class="font-black text-slate-800 mb-1 text-sm">Mushola & Toilet</h4>
                    <p class="text-xs font-semibold text-slate-500">Ibadah nyaman, toilet wangi.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-white px-6 border-t border-slate-100 reveal">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center gap-12">
            <div class="w-full md:w-1/2">
                <div class="relative">
                    <div class="absolute -inset-2 bg-gradient-to-r from-blue-100 to-emerald-100 rounded-[2rem] blur-lg opacity-50"></div>
                    <img src="https://images.unsplash.com/photo-1511512578047-dfb367046420?q=80&w=2071&auto=format&fit=crop" alt="Suasana Mabar" class="relative rounded-[2rem] shadow-xl border border-slate-200 hover:scale-[1.02] transition-transform duration-500">
                </div>
            </div>
            <div class="w-full md:w-1/2">
                <h2 class="text-3xl md:text-4xl font-black text-slate-800 mb-4 tracking-tight">Kenapa Pilih <span class="text-[#1e448e]">Rizki Rental?</span></h2>
                <p class="text-slate-500 mb-8 text-sm font-medium leading-relaxed">
                    Kami tidak hanya menyewakan konsol, tapi memberikan ruang hiburan terbaik untuk melepas penat bersama teman.
                </p>
                <ul class="space-y-4">
                    <li class="flex items-center gap-4 bg-slate-50 p-3 rounded-xl border border-slate-200 transition-all">
                        <div class="w-10 h-10 rounded-lg bg-blue-100 text-[#1e448e] flex items-center justify-center font-black flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span class="text-slate-700 font-extrabold text-sm">Bisa Booking via WhatsApp</span>
                    </li>
                    <li class="flex items-center gap-4 bg-slate-50 p-3 rounded-xl border border-slate-200 transition-all">
                        <div class="w-10 h-10 rounded-lg bg-blue-100 text-[#1e448e] flex items-center justify-center font-black flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span class="text-slate-700 font-extrabold text-sm">Bebas bawa cemilan dari luar</span>
                    </li>
                    <li class="flex items-center gap-4 bg-slate-50 p-3 rounded-xl border border-slate-200 transition-all">
                        <div class="w-10 h-10 rounded-lg bg-blue-100 text-[#1e448e] flex items-center justify-center font-black flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span class="text-slate-700 font-extrabold text-sm">Update game hits setiap bulan</span>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section id="lokasi" class="py-16 bg-slate-50 px-6 border-t border-slate-200 reveal">
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col lg:flex-row gap-10 items-center bg-white rounded-3xl p-6 lg:p-10 border border-slate-200 shadow-md">
                <div class="w-full lg:w-1/2">
                    <h2 class="text-3xl md:text-4xl font-black text-slate-800 mb-4 tracking-tight">Temukan <span class="text-[#1e448e]">Markas Kami</span></h2>
                    <p class="text-slate-500 mb-8 text-sm font-medium leading-relaxed">
                        Lokasi sangat strategis, gampang dicari, parkiran motor luas dan aman diawasi CCTV. Ayo kumpulin squad kamu sekarang!
                    </p>

                    <div class="flex items-start gap-4 mb-8 bg-slate-50 p-4 rounded-2xl border border-slate-200">
                        <div class="w-10 h-10 bg-blue-100 text-[#1e448e] rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <strong class="text-slate-800 block mb-1 text-sm font-black">Alamat Lengkap:</strong>
                            <span class="text-slate-600 font-medium text-xs leading-relaxed">Jl. RPL Sukses No. 1, Kecamatan Cibodas,<br> Kota Tangerang, Banten 15138</span>
                        </div>
                    </div>

                    <a href="#" class="inline-flex items-center gap-2 bg-[#25D366] text-white font-extrabold px-6 py-3 rounded-xl shadow-md hover:bg-[#1ebd57] hover:-translate-y-0.5 transition-all text-sm">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.82 9.82 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                        Tanya Ketersediaan
                    </a>
                </div>

                <div class="w-full lg:w-1/2 h-[300px] lg:h-[350px] bg-slate-100 p-2 rounded-3xl border border-slate-200 shadow-inner relative overflow-hidden">
                    <iframe class="rounded-2xl w-full h-full" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126920.2435777134!2d106.55138122394019!3d-6.229712711707011!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69fb20a9906e13%3A0xf77fe8c715db1578!2sTangerang%2C%20Kota%20Tangerang%2C%20Banten!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-[#15233c] text-slate-300 py-12 border-t-[6px] border-[#1e448e] relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5"></div>
        <div class="max-w-6xl mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8">

                <div class="md:col-span-5 flex flex-col gap-3">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo Footer" class="h-10 w-10 grayscale opacity-90 brightness-200">
                        <h3 class="text-2xl font-black text-white tracking-tight">RIZKI RENTAL</h3>
                    </div>
                    <p class="text-slate-400 leading-relaxed font-medium mt-1 max-w-sm text-sm">
                        Sistem Informasi Manajemen Rental PlayStation modern. Solusi mabar tanpa ribet, jujur, dan update real-time.
                    </p>
                </div>

                <div class="md:col-span-3">
                    <h4 class="text-white font-black text-base mb-4 uppercase tracking-wider">Quick Links</h4>
                    <ul class="space-y-3 font-bold text-slate-400 text-sm">
                        <li><a href="#status" class="hover:text-blue-300 transition-colors">❯ Status Unit</a></li>
                        <li><a href="#harga" class="hover:text-blue-300 transition-colors">❯ Paket & Pricelist</a></li>
                        <li><a href="#fasilitas" class="hover:text-blue-300 transition-colors">❯ Fasilitas Kami</a></li>
                        <li><a href="#lokasi" class="hover:text-blue-300 transition-colors">❯ Peta Lokasi</a></li>
                    </ul>
                </div>

                <div class="md:col-span-4">
                    <h4 class="text-white font-black text-base mb-4 uppercase tracking-wider">Connect With Us</h4>
                    <div class="flex flex-col gap-3">
                        <a href="#" class="flex items-center gap-3 bg-white/5 hover:bg-white/10 p-2.5 rounded-lg border border-white/10 transition-colors group">
                            <div class="bg-[#25D366] p-1.5 rounded text-white group-hover:scale-105 transition-transform">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.82 9.82 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                            </div>
                            <span class="font-bold text-slate-300 text-sm">WhatsApp (+62 812-XXXX)</span>
                        </a>
                        <a href="#" class="flex items-center gap-3 bg-white/5 hover:bg-white/10 p-2.5 rounded-lg border border-white/10 transition-colors group">
                            <div class="bg-gradient-to-tr from-amber-400 via-pink-500 to-purple-600 p-1.5 rounded text-white group-hover:scale-105 transition-transform">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                            </div>
                            <span class="font-bold text-slate-300 text-sm">@rizkirental.ps</span>
                        </a>
                        <a href="#" class="flex items-center gap-3 bg-white/5 hover:bg-white/10 p-2.5 rounded-lg border border-white/10 transition-colors group">
                            <div class="bg-[#1877F2] p-1.5 rounded text-white group-hover:scale-105 transition-transform">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </div>
                            <span class="font-bold text-slate-300 text-sm">Rizki Rental PS Official</span>
                        </a>
                    </div>
                </div>

            </div>

            <div class="border-t border-white/10 mt-10 pt-6 flex flex-col md:flex-row justify-between items-center gap-3 text-[11px] font-bold text-slate-500">
                <p>Dibuat untuk Tugas Akhir Jurusan RPL © 2026</p>
                <p>Designed with Care by Rizki</p>
            </div>
        </div>
    </footer>

    <div id="modalBooking" class="fixed inset-0 bg-slate-900/60 hidden flex items-center justify-center z-[99] backdrop-blur-sm p-4 transition-opacity duration-300">
        <div class="bg-white w-full max-w-sm rounded-3xl shadow-2xl overflow-hidden transform scale-100 border border-slate-200">

            <div class="bg-gradient-to-r from-[#1e448e] to-[#153166] p-5 flex items-center justify-center gap-2 text-white relative overflow-hidden">
                <div class="absolute right-0 top-0 w-24 h-24 bg-white/10 rounded-full blur-xl -mr-10 -mt-10"></div>
                <svg class="w-5 h-5 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                <h3 class="text-lg font-black uppercase tracking-widest relative z-10" id="modalTitle">Booking PC</h3>
            </div>

            <div class="p-6 bg-slate-50">
                @auth
                    <form action="{{ route('front.booking') }}" method="POST">
                        @csrf
                        <input type="hidden" name="console_id" id="inputConsoleId">

                        <div class="mb-5 text-center bg-blue-50/60 p-3.5 rounded-xl border border-blue-100 shadow-inner">
                            <p class="text-[10px] text-[#1e448e] font-black uppercase mb-1 tracking-widest">Booking Atas Nama:</p>
                            <p class="text-lg font-black text-[#153166] leading-none">{{ auth()->user()->name }}</p>
                        </div>

                        <div class="mb-6">
                            <label class="block text-xs font-extrabold text-slate-700 mb-2">Pilih Durasi Waktu (Jam) <span class="text-rose-500">*</span></label>
                            <select name="durasi_jam" class="w-full bg-white border border-slate-200 rounded-lg p-3 focus:ring-2 focus:ring-[#1e448e] focus:outline-none cursor-pointer font-bold text-slate-800 shadow-sm text-sm" required>
                                <option value="1">1 Jam</option>
                                <option value="2">2 Jam</option>
                                <option value="3">3 Jam</option>
                                <option value="4">4 Jam</option>
                                <option value="5">5 Jam</option>
                            </select>
                            <p class="text-[9px] text-slate-400 mt-2 text-center font-bold">*Saldo waktu kamu dipotong otomatis sesuai tipe konsol.</p>
                        </div>

                        <div class="flex gap-2">
                            <button type="button" onclick="tutupModalBooking()" class="w-1/3 py-2.5 bg-slate-200 text-slate-600 font-extrabold rounded-lg hover:bg-slate-300 transition text-sm">Batal</button>
                            <button type="submit" class="w-2/3 py-2.5 bg-gradient-to-r from-[#1e448e] to-[#153166] text-white font-extrabold rounded-lg hover:shadow-lg transition shadow-md hover:-translate-y-0.5 text-sm flex items-center justify-center gap-2">
                                Gas Booking!
                            </button>
                        </div>
                    </form>
                @else
                    <div class="text-center py-4">
                        <div class="w-16 h-16 bg-rose-50 text-rose-500 rounded-[1.5rem] flex items-center justify-center mx-auto mb-3 text-3xl border border-rose-100">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <h4 class="font-black text-slate-800 mb-1.5 text-lg">Kamu Belum Login!</h4>
                        <p class="text-xs text-slate-500 mb-6 font-bold leading-relaxed px-2">Silakan login terlebih dahulu untuk melakukan booking unit dan memakai saldo.</p>

                        <div class="flex gap-2">
                            <button type="button" onclick="tutupModalBooking()" class="w-1/2 py-2.5 bg-slate-200 text-slate-600 font-extrabold rounded-lg hover:bg-slate-300 transition text-sm">Kembali</button>
                            <a href="{{ route('login') }}" class="w-1/2 py-2.5 bg-gradient-to-r from-[#1e448e] to-[#153166] text-white font-extrabold rounded-lg transition shadow-md text-sm inline-block">Login</a>
                        </div>
                    </div>
                @endauth
            </div>

        </div>
    </div>

    @if(session('success'))
        <div id="toast-success" class="fixed top-20 right-6 flex items-center w-full max-w-sm p-3 mb-4 bg-white rounded-xl shadow-lg border-l-4 border-emerald-500 z-[100] transition-opacity duration-500">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-emerald-500 bg-emerald-50 rounded-lg">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/></svg>
            </div>
            <div class="ms-3 text-xs font-extrabold text-slate-700 leading-tight">{{ session('success') }}</div>
        </div>
        <script>
            setTimeout(() => {
                let toast = document.getElementById('toast-success');
                if(toast) {
                    toast.style.opacity = '0';
                    setTimeout(() => toast.remove(), 500);
                }
            }, 4000);
        </script>
    @endif

    @if(session('error'))
        <div id="toast-error" class="fixed top-20 right-6 flex items-center w-full max-w-sm p-3 mb-4 bg-white rounded-xl shadow-lg border-l-4 border-rose-500 z-[100] transition-opacity duration-500">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-rose-500 bg-rose-50 rounded-lg">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/></svg>
            </div>
            <div class="ms-3 text-xs font-extrabold text-slate-700 leading-tight">{{ session('error') }}</div>
        </div>
        <script>
            setTimeout(() => {
                let toast = document.getElementById('toast-error');
                if(toast) {
                    toast.style.opacity = '0';
                    setTimeout(() => toast.remove(), 500);
                }
            }, 4000);
        </script>
    @endif

    <script>
        function toggleNavMode() {
            const menu = document.getElementById('navModeMenu');
            const icon = document.getElementById('navModeIcon');
            if (menu.classList.contains('opacity-0')) {
                menu.classList.remove('opacity-0', 'invisible', 'scale-95');
                menu.classList.add('opacity-100', 'visible', 'scale-100');
                icon.classList.add('rotate-180');
            } else {
                closeNavMode();
            }
        }

        function closeNavMode() {
            const menu = document.getElementById('navModeMenu');
            const icon = document.getElementById('navModeIcon');
            if(menu) {
                menu.classList.add('opacity-0', 'invisible', 'scale-95');
                menu.classList.remove('opacity-100', 'visible', 'scale-100');
                icon.classList.remove('rotate-180');
            }
        }

        document.addEventListener('click', function(event) {
            const wrapper = document.getElementById('navModeDropdownWrapper');
            if (wrapper && !wrapper.contains(event.target)) {
                closeNavMode();
            }
        });

        function reveal() {
            var reveals = document.querySelectorAll(".reveal");
            for (var i = 0; i < reveals.length; i++) {
                var windowHeight = window.innerHeight;
                var elementTop = reveals[i].getBoundingClientRect().top;
                var elementVisible = 80;
                if (elementTop < windowHeight - elementVisible) {
                    reveals[i].classList.add("active");
                }
            }
        }
        window.addEventListener("scroll", reveal);
        reveal();

        function bukaModalBooking(id, nama_tv) {
            document.getElementById('inputConsoleId').value = id;
            document.getElementById('modalTitle').innerText = 'Booking ' + nama_tv;
            document.getElementById('modalBooking').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function tutupModalBooking() {
            document.getElementById('modalBooking').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        function jalankanTimer() {
            const timers = document.querySelectorAll('.countdown-timer');
            const sekarang = new Date().getTime();

            timers.forEach(timer => {
                if (!timer.getAttribute('data-endtime')) return;

                const waktuSelesai = new Date(timer.getAttribute('data-endtime')).getTime();
                const selisih = waktuSelesai - sekarang;

                if (selisih <= 0) {
                    timer.innerHTML = "00:00:00";
                    if (!timer.hasAttribute('data-refreshed')) {
                        timer.setAttribute('data-refreshed', 'true');
                        window.location.reload();
                    }
                } else {
                    const jam = Math.floor((selisih % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const menit = Math.floor((selisih % (1000 * 60 * 60)) / (1000 * 60));
                    const detik = Math.floor((selisih % (1000 * 60)) / 1000);

                    const formatJam = jam < 10 ? "0" + jam : jam;
                    const formatMenit = menit < 10 ? "0" + menit : menit;
                    const formatDetik = detik < 10 ? "0" + detik : detik;

                    timer.innerHTML = formatJam + ":" + formatMenit + ":" + formatDetik;
                }
            });
        }

        setInterval(jalankanTimer, 1000);
        jalankanTimer();

        function tampilToastBelumLogin() {
            let toastHtml = `
            <div id="toast-js" class="fixed top-20 right-6 flex items-center w-full max-w-sm p-3 mb-4 bg-white rounded-xl shadow-lg border-l-4 border-rose-500 z-[100] transition-opacity duration-500">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-rose-500 bg-rose-50 rounded-lg">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/></svg>
                </div>
                <div class="ms-3 text-xs font-extrabold text-slate-700 leading-tight">Kamu harus login dulu buat booking.</div>
            </div>`;

            document.body.insertAdjacentHTML('beforeend', toastHtml);
            let toast = document.getElementById('toast-js');

            setTimeout(() => {
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 500);
            }, 3000);
        }
    </script>
</body>
</html>
