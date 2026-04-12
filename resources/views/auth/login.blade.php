<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Rizki Rental PS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center p-4 selection:bg-[#2251a5] selection:text-white relative">

    <div class="w-full max-w-[900px] bg-white rounded-[2rem] shadow-2xl flex flex-col md:flex-row overflow-hidden relative z-10 border border-white/50">

        <a href="{{ route('front') }}" class="absolute top-6 right-6 text-slate-400 hover:text-red-500 hover:bg-red-50 p-2 rounded-full transition-all z-20">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
        </a>

        <div class="hidden md:flex w-1/2 bg-gradient-to-br from-[#1a3d7c] to-[#2251a5] relative p-12 flex-col justify-center overflow-hidden text-white">
            <div class="absolute -top-20 -left-20 w-80 h-80 bg-gradient-to-br from-white/10 to-transparent rounded-full border border-white/20"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-72 h-72 bg-gradient-to-tl from-white/10 to-transparent rounded-full border border-white/10"></div>
            <div class="absolute top-[30%] left-[20%] w-24 h-24 bg-white/5 rounded-full border border-white/30 backdrop-blur-sm shadow-xl"></div>

            <div class="relative z-10">
                <h1 class="text-4xl font-black mb-2 tracking-tight drop-shadow-md">WELCOME</h1>
                <h2 class="text-xl font-bold text-blue-200 mb-6 uppercase tracking-widest">RIZKI RENTAL POS</h2>
                <p class="text-blue-100 text-sm leading-relaxed max-w-sm font-medium">
                    Solusi cerdas kelola bisnis rental. Masuk ke dalam sistem untuk mengecek sisa waktu main atau melakukan booking unit favoritmu tanpa ribet.
                </p>
            </div>
        </div>

        <div class="w-full md:w-1/2 p-8 md:p-12 relative flex flex-col justify-center">

            <div class="mb-8 text-center md:text-left mt-4 md:mt-0">
                <h2 class="text-3xl font-black text-slate-800 tracking-tight">Sign In</h2>
                <p class="text-slate-500 text-sm mt-2 font-medium">Silakan masukkan detail akun kamu.</p>
            </div>

            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-sm font-bold flex items-center gap-3 animate-pulse">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>Email atau password salah.</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400 group-focus-within:text-[#2251a5] transition-colors" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                        </div>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full pl-12 pr-4 py-3.5 bg-slate-100 border-none rounded-xl focus:bg-blue-50 focus:ring-2 focus:ring-[#2251a5]/30 transition-all outline-none font-semibold text-slate-700 placeholder-slate-400"
                            placeholder="User Name / Email">
                    </div>
                </div>

                <div>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400 group-focus-within:text-[#2251a5] transition-colors" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                        </div>
                        <input type="password" name="password" required
                            class="w-full pl-12 pr-4 py-3.5 bg-slate-100 border-none rounded-xl focus:bg-blue-50 focus:ring-2 focus:ring-[#2251a5]/30 transition-all outline-none font-semibold text-slate-700 placeholder-slate-400"
                            placeholder="Password">
                    </div>
                </div>

                <div class="flex items-center justify-between pt-2">
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="checkbox" name="remember" class="w-4 h-4 text-[#2251a5] bg-slate-100 border-slate-300 rounded focus:ring-[#2251a5] cursor-pointer">
                        <span class="text-sm text-slate-500 font-medium group-hover:text-slate-800 transition-colors">Remember me</span>
                    </label>
                    <a href="#" class="text-sm font-bold text-[#2251a5] hover:underline">Forgot Password?</a>
                </div>

                <button type="submit" class="w-full bg-[#1a3d7c] hover:bg-[#2251a5] text-white font-black py-3.5 rounded-xl shadow-lg shadow-blue-900/20 hover:-translate-y-0.5 transition-all duration-200 mt-4 tracking-wide">
                    SIGN IN
                </button>
            </form>

            <div class="mt-8 text-center text-sm text-slate-500 font-medium">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-[#2251a5] font-black hover:underline transition-all">Sign Up</a>
            </div>
        </div>
    </div>
</body>
</html>
