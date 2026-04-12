<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Rizki Rental PS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center p-4 selection:bg-[#2251a5] selection:text-white relative">

    <div class="w-full max-w-[900px] bg-white rounded-[2rem] shadow-2xl flex flex-col md:flex-row overflow-hidden relative z-10 border border-white/50">

        <a href="{{ route('front') }}" class="absolute top-6 right-6 text-slate-400 hover:text-red-500 hover:bg-red-50 p-2 rounded-full transition-all z-20">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
        </a>

        <div class="hidden md:flex w-1/2 bg-gradient-to-bl from-[#1a3d7c] to-[#2251a5] relative p-12 flex-col justify-center overflow-hidden text-white">
            <div class="absolute -top-20 -right-20 w-80 h-80 bg-gradient-to-bl from-white/10 to-transparent rounded-full border border-white/20"></div>
            <div class="absolute bottom-[-10%] left-[-10%] w-72 h-72 bg-gradient-to-tr from-white/10 to-transparent rounded-full border border-white/10"></div>
            <div class="absolute top-[30%] right-[20%] w-24 h-24 bg-white/5 rounded-full border border-white/30 backdrop-blur-sm shadow-xl"></div>

            <div class="relative z-10 text-left">
                <h1 class="text-4xl font-black mb-2 tracking-tight drop-shadow-md">JOIN US</h1>
                <h2 class="text-xl font-bold text-blue-200 mb-6 uppercase tracking-widest">MABAR LEBIH SERU</h2>
                <p class="text-blue-100 text-sm leading-relaxed max-w-sm font-medium">
                    Buat akun kamu sekarang. Nikmati kemudahan booking TV, cek sisa waktu, dan promo menarik khusus buat player terdaftar.
                </p>
            </div>
        </div>

        <div class="w-full md:w-1/2 p-8 md:p-10 relative flex flex-col justify-center">

            <div class="mb-6 text-center md:text-left mt-4 md:mt-0">
                <h2 class="text-3xl font-black text-slate-800 tracking-tight">Sign Up</h2>
                <p class="text-slate-500 text-sm mt-2 font-medium">Daftar sekarang untuk mulai mabar.</p>
            </div>

            @if ($errors->any())
                <div class="mb-4 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-xs font-bold">
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
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400 group-focus-within:text-[#2251a5] transition-colors" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                        </div>
                        <input type="text" name="name" value="{{ old('name') }}" required autofocus
                            class="w-full pl-12 pr-4 py-3.5 bg-slate-100 border-none rounded-xl focus:bg-blue-50 focus:ring-2 focus:ring-[#2251a5]/30 transition-all outline-none font-semibold text-slate-700 placeholder-slate-400"
                            placeholder="Full Name">
                    </div>
                </div>

                <div>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400 group-focus-within:text-[#2251a5] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full pl-12 pr-4 py-3.5 bg-slate-100 border-none rounded-xl focus:bg-blue-50 focus:ring-2 focus:ring-[#2251a5]/30 transition-all outline-none font-semibold text-slate-700 placeholder-slate-400"
                            placeholder="Email Address">
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

                <div>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400 group-focus-within:text-[#2251a5] transition-colors" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                        </div>
                        <input type="password" name="password_confirmation" required
                            class="w-full pl-12 pr-4 py-3.5 bg-slate-100 border-none rounded-xl focus:bg-blue-50 focus:ring-2 focus:ring-[#2251a5]/30 transition-all outline-none font-semibold text-slate-700 placeholder-slate-400"
                            placeholder="Confirm Password">
                    </div>
                </div>

                <button type="submit" class="w-full bg-[#1a3d7c] hover:bg-[#2251a5] text-white font-black py-3.5 rounded-xl shadow-lg shadow-blue-900/20 hover:-translate-y-0.5 transition-all duration-200 mt-2 tracking-wide">
                    SIGN UP
                </button>
            </form>

            <div class="mt-6 text-center text-sm text-slate-500 font-medium">
                Already have an account?
                <a href="{{ route('login') }}" class="text-[#2251a5] font-black hover:underline transition-all">Sign In here</a>
            </div>
        </div>
    </div>
</body>
</html>
