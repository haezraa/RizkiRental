<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rizki Rental - Rental PS Terbaik</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; scroll-behavior: smooth; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased selection:bg-[#2251a5] selection:text-white">

    <nav class="bg-white/90 backdrop-blur-md border-b border-slate-200 shadow-sm sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-[1200px] mx-auto flex items-center justify-between px-6 py-4">
            <a class="flex items-center gap-2 group" href="#">
                <div class="bg-[#2251a5] text-white p-2 rounded-lg font-black group-hover:rotate-12 transition-transform">RR</div>
                <span class="text-xl font-black text-[#2251a5] tracking-tight">RIZKI RENTAL</span>
            </a>

            <div class="hidden md:flex items-center space-x-8 font-semibold text-sm">
                <a class="text-slate-500 hover:text-[#2251a5] transition-colors" href="#status">Status Unit</a>
                <a class="text-slate-500 hover:text-[#2251a5] transition-colors" href="#harga">Pricelist</a>
                <a class="text-slate-500 hover:text-[#2251a5] transition-colors" href="#fasilitas">Fasilitas</a>
                <a class="text-slate-500 hover:text-[#2251a5] transition-colors" href="#lokasi">Lokasi</a>

                @if(auth()->check() && auth()->user()->role === 'admin')
                    <div class="pl-6 border-l border-slate-200">
                        <select onchange="window.location.href=this.value" class="bg-blue-50 text-[#2251a5] border border-blue-200 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-[#2251a5] cursor-pointer text-xs font-bold hover:bg-blue-100 transition-colors">
                            <option value="{{ route('front') }}" selected>🌐 Mode User</option>
                            <option value="{{ route('home') }}">🖥️ Manajemen</option>
                        </select>
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <section class="relative bg-gradient-to-br from-[#1a3d7c] to-[#2251a5] overflow-hidden">
        <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-white opacity-10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-72 h-72 bg-blue-400 opacity-20 rounded-full blur-2xl"></div>

        <div class="relative max-w-[1200px] mx-auto px-6 py-24 md:py-32 flex flex-col items-center text-center z-10">
            <span class="bg-blue-500/30 border border-blue-400/50 text-blue-100 px-4 py-1.5 rounded-full text-xs font-bold tracking-wider mb-6 uppercase">
                Tempat Mabar Ter-Asik se-Tangerang
            </span>
            <h1 class="text-4xl md:text-6xl font-black text-white mb-6 tracking-tight leading-tight max-w-4xl">
                Tingkatkan Pengalaman <br> <span class="text-blue-300">Gaming Kamu</span> Disini.
            </h1>
            <p class="text-blue-100/80 text-lg md:text-xl max-w-2xl font-medium mb-10">
                Pantau ketersediaan unit secara real-time dari HP kamu. Gak perlu takut kehabisan tempat lagi!
            </p>
            <a href="#status" class="bg-white text-[#2251a5] font-bold px-8 py-4 rounded-xl shadow-lg hover:shadow-xl hover:bg-blue-50 hover:-translate-y-1 transition-all duration-300">
                Cek Ketersediaan Unit Sekarang
            </a>
        </div>

        <svg class="absolute bottom-0 w-full text-slate-50 translate-y-1" viewBox="0 0 1440 100" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,50 C320,150 420,-50 1440,50 L1440,100 L0,100 Z"></path>
        </svg>
    </section>

    <section id="status" class="py-20 px-6">
        <div class="max-w-[1200px] mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-black text-slate-800">Status <span class="text-[#2251a5]">Unit Real-time</span></h2>
                <p class="text-slate-500 mt-3 font-medium">Data di bawah ini update otomatis sesuai sistem kasir kami.</p>
            </div>

            @php
                $groupedConsoles = isset($consoles) ? $consoles->groupBy('type') : collect([]);
            @endphp

            <div class="space-y-10">
                @forelse($groupedConsoles as $type => $typeConsoles)
                    <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_8px_30px_rgb(34,81,165,0.08)] transition-shadow">
                        <div class="flex justify-between items-center mb-6 pb-4 border-b border-slate-100">
                            <h3 class="text-2xl font-black text-[#2251a5]">{{ $type }}</h3>
                            <span class="bg-slate-100 text-slate-500 text-sm font-bold px-3 py-1 rounded-full">Total {{ $typeConsoles->count() }} Unit</span>
                        </div>

                        <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-4">
                            @foreach($typeConsoles as $console)
                                @if($console->status == 'ready')
                                    <div class="rounded-2xl border-2 border-blue-100 bg-white p-4 text-center hover:border-blue-400 hover:shadow-md transition-all cursor-default">
                                        <div class="text-sm font-bold text-slate-700 mb-2">{{ $console->name }}</div>
                                        <div class="flex items-center justify-center gap-1.5 bg-blue-50 py-1 rounded-md">
                                            <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                                            <span class="text-[10px] text-blue-700 font-black tracking-wider uppercase">Ready</span>
                                        </div>
                                    </div>
                                @else
                                    <div class="rounded-2xl border-2 border-slate-100 bg-slate-50 p-4 text-center opacity-70">
                                        <div class="text-sm font-bold text-slate-500 mb-2">{{ $console->name }}</div>
                                        <div class="flex items-center justify-center gap-1.5 bg-red-50 py-1 rounded-md">
                                            <div class="w-2 h-2 rounded-full bg-red-400 animate-pulse"></div>
                                            <span class="text-[10px] text-red-600 font-black tracking-wider uppercase">Dipakai</span>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div class="text-center bg-white p-10 rounded-2xl shadow-sm border border-slate-100">
                        <span class="text-slate-400 font-bold">Data unit belum tersedia.</span>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="harga" class="py-20 bg-white px-6">
        <div class="max-w-[1100px] mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-black text-slate-800">Paket <span class="text-[#2251a5]">Harga Sewa</span></h2>
                <p class="text-slate-500 mt-3 font-medium">Harga jujur, kantong aman, mabar jalan terus.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
                <div class="bg-white border border-slate-200 rounded-3xl p-8 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                    <div class="text-center mb-6">
                        <h3 class="text-xl font-black text-slate-700 mb-2">PLAYSTATION 3</h3>
                        <p class="text-slate-400 text-sm">Cocok buat santai</p>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex justify-between items-center text-sm"><span class="font-bold text-slate-500">1 Jam</span><span class="font-black text-slate-800">Rp 5.000</span></li>
                        <li class="flex justify-between items-center text-sm"><span class="font-bold text-slate-500">2 Jam</span><span class="font-black text-slate-800">Rp 10.000</span></li>
                        <li class="flex justify-between items-center text-sm"><span class="font-bold text-slate-500">3 Jam</span><span class="font-black text-slate-800">Rp 15.000</span></li>
                        <li class="flex justify-between items-center bg-slate-50 p-3 rounded-xl mt-4 border border-slate-100">
                            <span class="font-bold text-[#2251a5] text-sm">Paket Malam</span>
                            <span class="font-black text-[#2251a5]">Rp 40.000</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-[#2251a5] rounded-3xl p-8 shadow-xl shadow-blue-900/20 transform md:scale-105 relative border border-blue-400/50">
                    <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-yellow-400 text-yellow-900 font-black text-xs px-4 py-1.5 rounded-full uppercase tracking-wider">
                        Paling Laris
                    </div>
                    <div class="text-center mb-6">
                        <h3 class="text-xl font-black text-white mb-2">PLAYSTATION 4</h3>
                        <p class="text-blue-200 text-sm">Grafis mantap, game lengkap</p>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex justify-between items-center text-sm"><span class="font-medium text-blue-100">1 Jam</span><span class="font-black text-white">Rp 10.000</span></li>
                        <li class="flex justify-between items-center text-sm"><span class="font-medium text-blue-100">2 Jam</span><span class="font-black text-white">Rp 20.000</span></li>
                        <li class="flex justify-between items-center text-sm"><span class="font-medium text-blue-100">3 Jam</span><span class="font-black text-white">Rp 28.000</span></li>
                        <li class="flex justify-between items-center bg-blue-600/50 p-3 rounded-xl mt-4 border border-blue-400/30">
                            <span class="font-bold text-yellow-300 text-sm">Paket Malam</span>
                            <span class="font-black text-yellow-300">Rp 80.000</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-white border border-slate-200 rounded-3xl p-8 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                    <div class="text-center mb-6">
                        <h3 class="text-xl font-black text-slate-700 mb-2">PLAYSTATION 5</h3>
                        <p class="text-slate-400 text-sm">Pengalaman next-gen</p>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex justify-between items-center text-sm"><span class="font-bold text-slate-500">1 Jam</span><span class="font-black text-slate-800">Rp 20.000</span></li>
                        <li class="flex justify-between items-center text-sm"><span class="font-bold text-slate-500">2 Jam</span><span class="font-black text-slate-800">Rp 40.000</span></li>
                        <li class="flex justify-between items-center text-sm"><span class="font-bold text-slate-500">3 Jam</span><span class="font-black text-slate-800">Rp 55.000</span></li>
                        <li class="flex justify-between items-center bg-slate-50 p-3 rounded-xl mt-4 border border-slate-100">
                            <span class="font-bold text-[#2251a5] text-sm">Paket Malam</span>
                            <span class="font-black text-[#2251a5]">Rp 150.000</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section id="fasilitas" class="py-20 bg-slate-50 px-6 border-y border-slate-200">
        <div class="max-w-[1200px] mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-black text-slate-800">Fasilitas <span class="text-[#2251a5]">Kenyamanan</span></h2>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm text-center group hover:-translate-y-1 hover:border-blue-200 transition-all">
                    <div class="w-16 h-16 bg-blue-50 text-[#2251a5] rounded-2xl flex items-center justify-center mx-auto mb-4 text-3xl group-hover:bg-[#2251a5] group-hover:text-white transition-colors">❄️</div>
                    <h4 class="font-bold text-slate-800 mb-1">Ruangan Ber-AC</h4>
                    <p class="text-xs text-slate-500">Dingin maksimal, anti gerah walau main ramean.</p>
                </div>
                <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm text-center group hover:-translate-y-1 hover:border-blue-200 transition-all">
                    <div class="w-16 h-16 bg-blue-50 text-[#2251a5] rounded-2xl flex items-center justify-center mx-auto mb-4 text-3xl group-hover:bg-[#2251a5] group-hover:text-white transition-colors">🍜</div>
                    <h4 class="font-bold text-slate-800 mb-1">Makan & Minum</h4>
                    <p class="text-xs text-slate-500">Tersedia Indomie, mie gelas, kopi, es teh, dll.</p>
                </div>
                <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm text-center group hover:-translate-y-1 hover:border-blue-200 transition-all">
                    <div class="w-16 h-16 bg-blue-50 text-[#2251a5] rounded-2xl flex items-center justify-center mx-auto mb-4 text-3xl group-hover:bg-[#2251a5] group-hover:text-white transition-colors">🛜</div>
                    <h4 class="font-bold text-slate-800 mb-1">WiFi Gratis</h4>
                    <p class="text-xs text-slate-500">Koneksi stabil buat main game online atau denger lagu.</p>
                </div>
                <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm text-center group hover:-translate-y-1 hover:border-blue-200 transition-all">
                    <div class="w-16 h-16 bg-blue-50 text-[#2251a5] rounded-2xl flex items-center justify-center mx-auto mb-4 text-3xl group-hover:bg-[#2251a5] group-hover:text-white transition-colors">🕌</div>
                    <h4 class="font-bold text-slate-800 mb-1">Mushola & Toilet</h4>
                    <p class="text-xs text-slate-500">Fasilitas ibadah bersih dan toilet wangi.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="lokasi" class="py-20 bg-white px-6">
        <div class="max-w-[1200px] mx-auto">
            <div class="flex flex-col md:flex-row gap-12 items-center bg-slate-50 rounded-3xl p-6 md:p-12 border border-slate-100 shadow-sm">
                <div class="w-full md:w-1/2">
                    <h2 class="text-3xl font-black text-slate-800 mb-4">Temukan <span class="text-[#2251a5]">Markas Kami</span></h2>
                    <p class="text-slate-500 mb-8 leading-relaxed font-medium">
                        Lokasi sangat strategis, gampang dicari, parkiran motor luas dan aman diawasi CCTV. Ayo kumpulin squad kamu sekarang!
                    </p>

                    <div class="flex items-start gap-4 mb-8 bg-white p-4 rounded-2xl border border-slate-200">
                        <div class="w-10 h-10 bg-blue-50 text-[#2251a5] rounded-full flex items-center justify-center flex-shrink-0 font-bold">📍</div>
                        <div>
                            <strong class="text-slate-800 block mb-1">Alamat Lengkap:</strong>
                            <span class="text-slate-500 text-sm">Jl. RPL Sukses No. 1, Kecamatan Cibodas, Kota Tangerang, Banten 15138</span>
                        </div>
                    </div>

                    <a href="#" class="inline-flex items-center gap-2 bg-green-500 text-white font-bold px-8 py-4 rounded-xl shadow-lg hover:bg-green-600 hover:-translate-y-1 transition-all">
                        <span>Hubungi via WhatsApp</span>
                    </a>
                </div>

                <div class="w-full md:w-1/2 h-72 md:h-96 bg-white p-2 rounded-3xl border border-slate-200 shadow-sm relative overflow-hidden">
                    <iframe class="rounded-2xl w-full h-full" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126920.24036681022!2d106.55406085!3d-6.229728!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f8e853d2e38d%3A0x301576d14feb9c0!2sTangerang%2C%20Tangerang%20City%2C%20Banten!5e0!3m2!1sen!2sid!4v1710345678901!5m2!1sen!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-[#1a2b4c] text-slate-300 py-12">
        <div class="max-w-[1200px] mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
                <h3 class="text-2xl font-black text-white mb-2 tracking-tight">RIZKI RENTAL</h3>
                <p class="text-sm text-slate-400">Sistem Informasi Manajemen Rental PlayStation</p>
            </div>
            <div class="text-center md:text-right text-sm text-slate-400">
                <p>Dibuat untuk Tugas Akhir Jurusan RPL © 2026</p>
                <div class="flex justify-center md:justify-end space-x-4 mt-2">
                    <a href="#" class="hover:text-white transition-colors">Instagram</a>
                    <a href="#" class="hover:text-white transition-colors">Facebook</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
