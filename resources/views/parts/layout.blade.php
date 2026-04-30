<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rizki Rental PS - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand-blue': '#1e448e',
                        'brand-blue-light': '#2a5bba',
                        'brand-dark': '#0f172a',
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        .glass-sidebar {
            background: linear-gradient(180deg, #1e448e 0%, #153166 100%);
        }
        .nav-item.active {
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
            font-weight: 700;
        }
    </style>
</head>

<body class="bg-slate-50 text-brand-dark font-sans flex h-screen overflow-hidden selection:bg-brand-blue selection:text-white">

    <aside class="w-64 glass-sidebar text-white flex flex-col shadow-2xl relative z-20 flex-shrink-0 transition-all duration-300 rounded-[2rem] my-4 ml-4 mr-3 h-[calc(100vh-2rem)] overflow-hidden border border-white/10">

        <div class="pt-8 pb-6 px-6 flex flex-col items-center justify-center relative">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full blur-2xl -mr-10 -mt-10"></div>
            <div class="bg-white p-2.5 rounded-xl shadow-sm mb-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Rental" class="h-10 w-10 object-contain">
            </div>
            <h1 class="text-xl font-black tracking-tight text-white leading-none">RIZKI RENTAL</h1>
            <p class="text-[10px] text-blue-200 font-semibold tracking-widest mt-1 uppercase opacity-80">Admin Panel</p>
        </div>

        <div class="mx-4 mb-6 p-3 bg-white/10 rounded-2xl border border-white/5 backdrop-blur-sm flex items-center gap-3 hover:bg-white/20 transition-colors cursor-default">
            <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center font-bold text-white text-sm">
                {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
            </div>
            <div class="flex-1 overflow-hidden">
                <p class="text-sm font-bold text-white truncate">{{ Auth::user()->name ?? 'Administrator' }}</p>
            </div>
        </div>

        <nav class="flex-1 px-3 py-2 overflow-y-auto space-y-1.5 scrollbar-hide">

            <p class="px-3 text-[10px] font-bold text-blue-300/70 uppercase tracking-widest mb-2 mt-2">Main Menu</p>

            <a href="{{ route('home') }}" class="nav-item flex items-center px-4 py-3 rounded-xl transition-all duration-200 {{ Request::routeIs('home') ? 'active shadow-lg' : 'text-blue-100/70 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span class="font-semibold text-sm">Dashboard</span>
            </a>

            <a href="{{ route('rental') }}" class="nav-item flex items-center px-4 py-3 rounded-xl transition-all duration-200 {{ Request::routeIs('rental') ? 'active shadow-lg' : 'text-blue-100/70 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                <span class="font-semibold text-sm">Rental Area</span>
            </a>

            <a href="{{ route('fnb.cashier') }}" class="nav-item flex items-center px-4 py-3 rounded-xl transition-all duration-200 {{ Request::routeIs('fnb.cashier') ? 'active shadow-lg' : 'text-blue-100/70 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                <span class="font-semibold text-sm">Kasir M&M</span>
            </a>

            <div class="h-2"></div>
            <p class="px-3 text-[10px] font-bold text-blue-300/70 uppercase tracking-widest mb-2">Management</p>

            <a href="{{ route('fnb.index') }}" class="nav-item flex items-center px-4 py-3 rounded-xl transition-all duration-200 {{ Request::routeIs('fnb.index') ? 'active shadow-lg' : 'text-blue-100/70 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                <span class="font-semibold text-sm">Stok Gudang</span>
            </a>

            <a href="{{ route('admin.users') }}" class="nav-item flex items-center px-4 py-3 rounded-xl transition-all duration-200 {{ Request::routeIs('admin.users*') ? 'active shadow-lg' : 'text-blue-100/70 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                <span class="font-semibold text-sm">Data Player</span>
            </a>

            <a href="{{ route('reports.index') }}" class="nav-item flex items-center px-4 py-3 rounded-xl transition-all duration-200 {{ Request::routeIs('reports*') ? 'active shadow-lg' : 'text-blue-100/70 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                <span class="font-semibold text-sm">Laporan & Histori</span>
            </a>
        </nav>

        <div class="p-4 border-t border-white/10 bg-black/10">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center px-4 py-2.5 bg-red-500/10 text-red-200 hover:bg-red-500 hover:text-white rounded-xl transition-all duration-300 font-bold group">
                    <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    <span>Logout Sesi</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-hidden relative bg-slate-50">

        <div class="pt-4 pr-4 pl-1 pb-0 shrink-0 z-20">
            <header class="h-16 bg-white/90 backdrop-blur-md flex justify-between items-center px-6 shadow-sm rounded-2xl border border-slate-200">
                <h2 class="text-xl font-extrabold text-slate-800 tracking-tight">
                    @yield('judul_halaman')
                </h2>

                <div class="flex items-center gap-4">
                    @if(auth()->check() && auth()->user()->role === 'admin')

                        <div class="relative" id="modeDropdownWrapper">
                            <button onclick="toggleModeDropdown()" class="flex items-center gap-2 bg-slate-100 hover:bg-slate-200 text-brand-blue font-bold py-2 px-4 rounded-xl transition-colors text-sm border border-slate-200 outline-none">
                                <span>Mode Admin</span>
                                <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" id="modeDropdownIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>

                            <div id="modeDropdownMenu" class="absolute right-0 mt-2 w-36 bg-white rounded-xl shadow-[0_10px_25px_-5px_rgba(0,0,0,0.1)] border border-slate-100 opacity-0 invisible scale-95 origin-top-right transition-all duration-200 z-50">
                                <div class="p-1.5 flex flex-col gap-0.5">
                                    <a href="{{ route('home') }}" class="px-4 py-2.5 text-sm font-bold text-brand-blue bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors">
                                        Mode Admin
                                    </a>
                                    <a href="{{ route('front') }}" class="px-4 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-100 hover:text-slate-900 rounded-lg transition-colors">
                                        Mode User
                                    </a>
                                </div>
                            </div>
                        </div>

                    @endif
                    @yield('header_actions')
                </div>
            </header>
        </div>

        <div class="flex-1 overflow-y-auto pr-4 pl-1 pb-6 pt-6 scrollbar-hide">
            @yield('konten')
        </div>
    </main>

    <div id="globalConfirmModal" class="fixed inset-0 bg-slate-900/60 hidden flex items-center justify-center z-[99] backdrop-blur-sm p-4 transition-opacity duration-300">
        <div class="bg-white w-full max-w-sm rounded-3xl shadow-2xl overflow-hidden transform transition-all">
            <div class="bg-red-50 p-6 flex flex-col items-center justify-center text-center">
                <div class="bg-white p-3 rounded-full mb-4 shadow-sm">
                    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-extrabold text-slate-800" id="confirmTitle">Konfirmasi Aksi</h3>
                <p class="text-sm text-slate-500 mt-2 px-2 font-medium" id="confirmMessage">Yakin ingin melakukan ini?</p>
            </div>
            <div class="p-5 flex gap-3 bg-white border-t border-slate-100">
                <button onclick="closeConfirmModal()" class="flex-1 py-3 bg-slate-100 text-slate-700 font-bold rounded-xl hover:bg-slate-200 transition-colors">
                    Batal
                </button>
                <button id="confirmYesBtn" class="flex-1 py-3 bg-red-600 text-white font-bold rounded-xl shadow-lg shadow-red-200 hover:bg-red-700 hover:shadow-red-300 transition-all">
                    Ya, Lanjutkan
                </button>
            </div>
        </div>
    </div>

    <script>
        let targetFormId = null;
        function openConfirm(message, formId) {
            document.getElementById('confirmMessage').innerText = message;
            targetFormId = formId;
            document.getElementById('globalConfirmModal').classList.remove('hidden');
        }
        function closeConfirmModal() {
            document.getElementById('globalConfirmModal').classList.add('hidden');
            targetFormId = null;
        }
        document.getElementById('confirmYesBtn').addEventListener('click', function() {
            if (targetFormId) document.getElementById(targetFormId).submit();
            closeConfirmModal();
        });

        function toggleModeDropdown() {
            const menu = document.getElementById('modeDropdownMenu');
            const icon = document.getElementById('modeDropdownIcon');

            if (menu.classList.contains('opacity-0')) {
                menu.classList.remove('opacity-0', 'invisible', 'scale-95');
                menu.classList.add('opacity-100', 'visible', 'scale-100');
                icon.classList.add('rotate-180');
            } else {
                menu.classList.add('opacity-0', 'invisible', 'scale-95');
                menu.classList.remove('opacity-100', 'visible', 'scale-100');
                icon.classList.remove('rotate-180');
            }
        }

        document.addEventListener('click', function(event) {
            const wrapper = document.getElementById('modeDropdownWrapper');
            if (wrapper && !wrapper.contains(event.target)) {
                const menu = document.getElementById('modeDropdownMenu');
                const icon = document.getElementById('modeDropdownIcon');

                menu.classList.add('opacity-0', 'invisible', 'scale-95');
                menu.classList.remove('opacity-100', 'visible', 'scale-100');
                icon.classList.remove('rotate-180');
            }
        });
    </script>
</body>
</html>
