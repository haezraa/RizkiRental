<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Up Waktu Billing - Rizki Rental</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen">

    <nav class="bg-white border-b border-slate-200 shadow-sm sticky top-0 z-50">
        <div class="max-w-[1200px] mx-auto flex items-center justify-between px-6 py-4">
            <a class="flex items-center gap-3" href="{{ route('front') }}">
                <span class="text-xl font-black text-[#2251a5]">RIZKI RENTAL</span>
            </a>
            <div class="flex gap-4">
                <a href="{{ route('front') }}" class="text-sm font-bold text-slate-500 hover:text-[#2251a5] transition pt-2">← Kembali ke Home</a>
            </div>
        </div>
    </nav>

    <div class="max-w-[1000px] mx-auto px-6 py-12">
        <div class="mb-8 text-center md:text-left">
            <h2 class="text-3xl font-black text-slate-800">Halo, <span class="text-[#2251a5]">{{ $user->name }}</span>! 🎮</h2>
            <p class="text-slate-500 mt-2 font-medium">Beli paket waktu kamu di sini sebelum mulai mabar.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="md:col-span-1 space-y-4">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                    <h3 class="font-bold text-slate-700 border-b border-slate-100 pb-3 mb-4 uppercase text-sm tracking-wider">Dompet Waktu Kamu</h3>

                    <div class="flex justify-between items-center mb-3">
                        <span class="font-bold text-slate-500 text-sm">PlayStation 3</span>
                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-md text-xs font-black">{{ floor($user->saldo_ps3/60) }}j {{ $user->saldo_ps3%60 }}m</span>
                    </div>
                    <div class="flex justify-between items-center mb-3">
                        <span class="font-bold text-slate-500 text-sm">PlayStation 4</span>
                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-md text-xs font-black">{{ floor($user->saldo_ps4/60) }}j {{ $user->saldo_ps4%60 }}m</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-bold text-slate-500 text-sm">PlayStation 5</span>
                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-md text-xs font-black">{{ floor($user->saldo_ps5/60) }}j {{ $user->saldo_ps5%60 }}m</span>
                    </div>
                </div>
            </div>

            <div class="md:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="bg-[#2251a5] p-6 text-white text-center">
                    <h3 class="text-2xl font-black uppercase tracking-wider">Top Up Waktu Billing</h3>
                </div>

                <form action="{{ route('user.topup.store') }}" method="POST" class="p-8">
                    @csrf

                    <div class="mb-6">
                        <label class="block text-sm font-bold text-slate-700 mb-3">Pilih Konsol <span class="text-red-500">*</span></label>
                        <div class="grid grid-cols-3 gap-4">
                            <label class="cursor-pointer relative">
                                <input type="radio" name="tipe_ps" value="PS3" class="peer sr-only" required>
                                <div class="p-4 rounded-xl border-2 border-slate-200 text-slate-500 peer-checked:border-[#2251a5] peer-checked:bg-blue-50 peer-checked:text-[#2251a5] font-black text-center transition-all hover:bg-slate-50">PS 3</div>
                            </label>
                            <label class="cursor-pointer relative">
                                <input type="radio" name="tipe_ps" value="PS4" class="peer sr-only">
                                <div class="p-4 rounded-xl border-2 border-slate-200 text-slate-500 peer-checked:border-[#2251a5] peer-checked:bg-blue-50 peer-checked:text-[#2251a5] font-black text-center transition-all hover:bg-slate-50">PS 4</div>
                            </label>
                            <label class="cursor-pointer relative">
                                <input type="radio" name="tipe_ps" value="PS5" class="peer sr-only">
                                <div class="p-4 rounded-xl border-2 border-slate-200 text-slate-500 peer-checked:border-[#2251a5] peer-checked:bg-blue-50 peer-checked:text-[#2251a5] font-black text-center transition-all hover:bg-slate-50">PS 5</div>
                            </label>
                        </div>
                    </div>

                    <div class="mb-8">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Mau Beli Berapa Jam? <span class="text-red-500">*</span></label>
                        <select name="durasi_jam" class="w-full border-2 border-slate-200 rounded-xl p-4 focus:ring-0 focus:border-[#2251a5] font-bold text-slate-700 cursor-pointer" required>
                            <option value="" disabled selected>-- Pilih Paket Jam --</option>
                            <option value="1">1 Jam</option>
                            <option value="2">2 Jam</option>
                            <option value="3">3 Jam</option>
                            <option value="4">4 Jam</option>
                            <option value="5">5 Jam (Paket Begadang)</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full py-4 bg-[#2251a5] text-white font-black text-lg rounded-xl hover:bg-blue-800 transition shadow-lg hover:-translate-y-1">
                        BAYAR & TOP UP SEKARANG
                    </button>
                    <p class="text-xs text-center text-slate-400 mt-4 font-medium">* Simulasi Tugas: Saldo akan langsung bertambah tanpa perlu transfer beneran.</p>
                </form>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div id="toast" class="fixed top-10 right-10 bg-green-500 text-white px-6 py-4 rounded-xl font-bold shadow-2xl z-50 flex gap-3 items-center">
            <span>✅</span> {{ session('success') }}
        </div>
        <script>setTimeout(() => document.getElementById('toast').remove(), 4000);</script>
    @endif
</body>
</html>
