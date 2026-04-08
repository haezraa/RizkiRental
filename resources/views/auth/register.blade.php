<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Rizki Rental PS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4 relative overflow-hidden selection:bg-[#2251a5] selection:text-white">

    <div class="absolute top-[-10%] right-[-10%] w-96 h-96 bg-blue-400/20 rounded-full blur-3xl z-0 pointer-events-none"></div>
    <div class="absolute bottom-[-10%] left-[-10%] w-96 h-96 bg-[#2251a5]/15 rounded-full blur-3xl z-0 pointer-events-none"></div>

    <div class="w-full max-w-[420px] bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-slate-100 p-8 sm:p-10 relative z-10 transform transition-all my-8">

        <a href="{{ route('front') }}" class="absolute top-5 right-5 text-slate-400 hover:text-red-500 bg-slate-50 hover:bg-red-50 p-2 rounded-full transition-colors z-20">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </a>

        <div class="text-center mb-8 mt-2">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Rizki Rental" class="h-16 w-16 mx-auto mb-4 drop-shadow-sm hover:scale-105 transition-transform">
            <h2 class="text-2xl font-black text-slate-800 tracking-tight">RIZKI RENTAL</h2>
            <p class="text-slate-500 text-sm mt-1 font-medium">Daftar sekarang buat mabar sepuasnya! 🎮</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-sm font-bold">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Nama Player</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400 group-focus-within:text-[#2251a5] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus
                        class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#2251a5]/20 focus:border-[#2251a5] transition-all outline-none font-semibold text-slate-700 placeholder-slate-400"
                        placeholder="Nama kamu">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Email Address</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400 group-focus-within:text-[#2251a5] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                    </div>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#2251a5]/20 focus:border-[#2251a5] transition-all outline-none font-semibold text-slate-700 placeholder-slate-400"
                        placeholder="nama@email.com">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Password</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400 group-focus-within:text-[#2251a5] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <input type="password" name="password" required
                        class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#2251a5]/20 focus:border-[#2251a5] transition-all outline-none font-semibold text-slate-700 placeholder-slate-400"
                        placeholder="Minimal 8 karakter">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Ulangi Password</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400 group-focus-within:text-[#2251a5] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <input type="password" name="password_confirmation" required
                        class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#2251a5]/20 focus:border-[#2251a5] transition-all outline-none font-semibold text-slate-700 placeholder-slate-400"
                        placeholder="Ketik ulang password">
                </div>
            </div>

            <button type="submit" class="w-full bg-[#2251a5] hover:bg-blue-800 text-white font-black py-4 rounded-xl shadow-[0_4px_14px_0_rgb(34,81,165,0.39)] hover:shadow-[0_6px_20px_rgba(34,81,165,0.23)] hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2 mt-4">
                <span>DAFTAR SEKARANG</span>
            </button>
        </form>

        <p class="mt-8 text-center text-sm text-slate-500 font-medium">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-[#2251a5] font-black hover:underline transition-all">Masuk di sini</a>
        </p>
    </div>

</body>
</html>
