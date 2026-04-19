<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Up Waktu - Rizki Rental</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased selection:bg-[#2251a5] selection:text-white pb-20">

    <nav class="bg-white/90 backdrop-blur-md border-b border-slate-200 shadow-sm sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-[1200px] mx-auto flex items-center justify-between px-6 py-4">
            <a class="flex items-center gap-3 group" href="{{ route('front') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Rizki Rental" class="h-10 w-10 transition-transform duration-300 group-hover:scale-110 drop-shadow-sm">
                <span class="text-xl font-black text-[#2251a5] tracking-tight">RIZKI RENTAL</span>
            </a>

            <div class="hidden md:flex items-center space-x-6 font-semibold text-sm">
                <a class="text-slate-500 hover:text-[#2251a5] transition-colors" href="{{ route('front') }}#status">Status Unit</a>
                <a class="text-slate-500 hover:text-[#2251a5] transition-colors" href="{{ route('front') }}#harga">Pricelist</a>
                <a class="text-slate-500 hover:text-[#2251a5] transition-colors" href="{{ route('front') }}#fasilitas">Fasilitas</a>
                <a class="text-slate-500 hover:text-[#2251a5] transition-colors" href="{{ route('front') }}#lokasi">Lokasi</a>

                <div class="h-6 w-px bg-slate-200 mx-2"></div>

                @if(auth()->check())
                    @if(auth()->user()->role === 'admin')
                        <select onchange="window.location.href=this.value" class="bg-blue-50 text-[#2251a5] border border-blue-200 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-[#2251a5] cursor-pointer text-xs font-bold hover:bg-blue-100 transition-colors">
                            <option value="{{ route('front') }}" selected>Mode User</option>
                            <option value="{{ route('home') }}">Manajemen</option>
                        </select>
                    @endif

                    <a href="{{ route('user.topup') }}" class="bg-blue-100 text-[#2251a5] px-4 py-2 rounded-lg font-bold hover:bg-blue-200 transition-colors border border-blue-200 shadow-sm">
                        Top Up Saldo
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="text-red-500 hover:text-white border border-red-500 hover:bg-red-500 px-4 py-2 rounded-lg font-bold transition-all duration-300">
                            Logout
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </nav>

    <div class="max-w-[700px] mx-auto px-6 py-12 md:py-16">

        <div class="text-center mb-10">
            <h2 class="text-3xl md:text-4xl font-black text-slate-800 tracking-tight">Hi, <span class="text-[#2251a5]">{{ explode(' ', $user->name)[0] }}!</span></h2>
            <p class="text-slate-500 mt-3 font-medium">Isi dompet waktu kamu dan langsung gaskeun mabar tanpa ribet antri di kasir.</p>
        </div>

        <div class="bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100 overflow-hidden mb-8 relative">
            <div class="absolute top-0 right-0 w-40 h-40 bg-blue-100 rounded-full blur-3xl -mr-10 -mt-10 opacity-60"></div>

            <div class="relative z-10">
                <div class="bg-slate-50 px-8 py-5 border-b border-slate-100">
                    <h3 class="text-lg font-black text-slate-800 flex items-center gap-2">
                        Dompet Waktu
                    </h3>
                </div>

                <div class="p-8">
                    <div class="grid grid-cols-3 gap-3 md:gap-6">
                        <div class="text-center p-4 bg-[#2251a5] rounded-2xl border border-blue-800 shadow-md text-white transition-colors">
                            <div class="text-xs font-bold text-blue-200 mb-1">PS 3</div>
                            <div class="text-lg md:text-xl font-black text-white">{{ floor($user->saldo_ps3/60) }}<span class="text-sm text-blue-300 font-bold">j</span> {{ $user->saldo_ps3%60 }}<span class="text-sm text-blue-300 font-bold">m</span></div>
                        </div>

                        <div class="text-center p-4 bg-[#2251a5] rounded-2xl border border-blue-800 shadow-md text-white transition-colors">
                            <div class="text-xs font-bold text-blue-200 mb-1">PS 4</div>
                            <div class="text-lg md:text-xl font-black text-white">{{ floor($user->saldo_ps4/60) }}<span class="text-sm text-blue-300 font-bold">j</span> {{ $user->saldo_ps4%60 }}<span class="text-sm text-blue-300 font-bold">m</span></div>
                        </div>

                        <div class="text-center p-4 bg-[#2251a5] rounded-2xl border border-blue-800 shadow-md text-white transition-colors">
                            <div class="text-xs font-bold text-blue-200 mb-1">PS 5</div>
                            <div class="text-lg md:text-xl font-black text-white">{{ floor($user->saldo_ps5/60) }}<span class="text-sm text-blue-300 font-bold">j</span> {{ $user->saldo_ps5%60 }}<span class="text-sm text-blue-300 font-bold">m</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100 overflow-hidden mb-8">
            <div class="bg-slate-50 px-8 py-5 border-b border-slate-100">
                <h3 class="text-lg font-black text-slate-800 flex items-center gap-2">
                    Beli Paket Waktu
                </h3>
            </div>

            <form action="{{ route('user.topup.store') }}" method="POST" class="p-8">
                @csrf

                <div class="mb-8">
                    <label class="block text-sm font-bold text-slate-700 mb-3">Pilih Konsol <span class="text-red-500">*</span></label>
                    <div class="grid grid-cols-3 gap-4">
                        <label class="cursor-pointer relative group">
                            <input type="radio" name="tipe_ps" value="PS3" class="peer sr-only" required>
                            <div class="p-4 rounded-2xl border-2 border-slate-200 text-slate-500 peer-checked:border-[#2251a5] peer-checked:bg-blue-50 peer-checked:text-[#2251a5] font-black text-center transition-all group-hover:bg-slate-50">
                                PS 3
                            </div>
                            <div class="absolute top-2 right-2 hidden peer-checked:block text-[#2251a5]">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            </div>
                        </label>
                        <label class="cursor-pointer relative group">
                            <input type="radio" name="tipe_ps" value="PS4" class="peer sr-only">
                            <div class="p-4 rounded-2xl border-2 border-slate-200 text-slate-500 peer-checked:border-[#2251a5] peer-checked:bg-blue-50 peer-checked:text-[#2251a5] font-black text-center transition-all group-hover:bg-slate-50">
                                PS 4
                            </div>
                            <div class="absolute top-2 right-2 hidden peer-checked:block text-[#2251a5]">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            </div>
                        </label>
                        <label class="cursor-pointer relative group">
                            <input type="radio" name="tipe_ps" value="PS5" class="peer sr-only">
                            <div class="p-4 rounded-2xl border-2 border-slate-200 text-slate-500 peer-checked:border-[#2251a5] peer-checked:bg-blue-50 peer-checked:text-[#2251a5] font-black text-center transition-all group-hover:bg-slate-50">
                                PS 5
                            </div>
                            <div class="absolute top-2 right-2 hidden peer-checked:block text-[#2251a5]">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="mb-8">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Mau Beli Berapa Jam? <span class="text-red-500">*</span></label>
                    <select name="durasi_jam" class="w-full border-2 border-slate-200 rounded-2xl p-4 focus:ring-0 focus:border-[#2251a5] font-bold text-slate-700 cursor-pointer bg-slate-50 transition-colors hover:bg-white" required>
                        <option value="" disabled selected>  Pilih Paket Jam </option>
                        <option value="1">1 Jam</option>
                        <option value="2">2 Jam</option>
                        <option value="3">3 Jam</option>
                        <option value="4">4 Jam</option>
                        <option value="5">5 Jam (Paket Begadang)</option>
                    </select>
                </div>

                <button type="submit" class="w-full py-4 bg-[#2251a5] text-white font-black text-lg rounded-2xl hover:bg-blue-800 transition shadow-lg hover:shadow-xl hover:-translate-y-1 flex items-center justify-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    BAYAR & TOP UP SEKARANG
                </button>

                <p class="text-xs text-center text-slate-400 mt-5 font-medium flex items-center justify-center gap-1">
                    <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Simulasi Tugas: Saldo otomatis bertambah (Bypass Payment)
                </p>
            </form>
        </div>

        <div class="bg-blue-50/50 rounded-3xl p-6 md:p-8 border border-blue-100">
            <h3 class="text-sm font-black text-[#2251a5] uppercase tracking-wider mb-6 text-center">Cara Booking & Main</h3>

            <div class="space-y-6">
                <div class="flex gap-4 items-start">
                    <div class="w-10 h-10 rounded-full bg-white border-2 border-[#2251a5] text-[#2251a5] font-black flex items-center justify-center flex-shrink-0 shadow-sm">1</div>
                    <div>
                        <h4 class="font-bold text-slate-800">Isi Saldo Waktu</h4>
                        <p class="text-sm text-slate-500 mt-1 leading-relaxed">Pilih tipe konsol yang mau kamu mainin (PS3, PS4, atau PS5) dan beli durasi jamnya di form atas. Saldo otomatis masuk ke dompet kamu.</p>
                    </div>
                </div>

                <div class="flex gap-4 items-start">
                    <div class="w-10 h-10 rounded-full bg-white border-2 border-[#2251a5] text-[#2251a5] font-black flex items-center justify-center flex-shrink-0 shadow-sm">2</div>
                    <div>
                        <h4 class="font-bold text-slate-800">Pilih TV Ready</h4>
                        <p class="text-sm text-slate-500 mt-1 leading-relaxed">Kembali ke halaman utama, cari kotak TV yang statusnya warna hijau <span class="font-bold text-green-600">READY</span>, lalu klik TV tersebut.</p>
                    </div>
                </div>

                <div class="flex gap-4 items-start">
                    <div class="w-10 h-10 rounded-full bg-white border-2 border-[#2251a5] text-[#2251a5] font-black flex items-center justify-center flex-shrink-0 shadow-sm">3</div>
                    <div>
                        <h4 class="font-bold text-slate-800">Gas Booking!</h4>
                        <p class="text-sm text-slate-500 mt-1 leading-relaxed">Pilih durasi main di popup, klik booking. Waktu kamu di dompet otomatis terpotong, dan kamu siap mabar!</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @if(session('success'))
        <div id="toast-success" class="fixed top-24 right-6 flex items-center w-full max-w-sm p-4 mb-4 bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.12)] border-l-4 border-green-500 z-[100] transition-opacity duration-500">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-10 h-10 text-green-500 bg-green-100 rounded-xl">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/></svg>
            </div>
            <div class="ms-3 text-sm font-bold text-slate-700 leading-tight">{{ session('success') }}</div>
        </div>
        <script>
            setTimeout(() => {
                let toast = document.getElementById('toast-success');
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 500);
            }, 4000);
        </script>
    @endif
</body>
</html>
