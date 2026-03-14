<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rizki Rental PS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand-blue': '#2251a5',
                        'brand-dark': '#1a1a1a',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }

        .rotate-180 {
            transform: rotate(180deg);
        }
    </style>
</head>

<body class="bg-gray-100 text-brand-dark font-sans">

    <div class="flex h-screen overflow-hidden bg-gray-100">

        <aside class="w-64 bg-brand-blue text-white flex flex-col shadow-2xl relative z-20 flex-shrink-0 transition-all duration-300">

            <div class="h-20 flex items-center px-6 border-b border-white/10 bg-brand-blue z-10 gap-4">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Rental" class="h-14 w-14 object-contain shadow-sm bg-white/10">
                <div class="text-left">
                    <h1 class="text-sm font-black tracking-wider text-white leading-none">RIZKI RENTAL</h1>
                    <p class="text-[10px] text-blue-200 font-bold tracking-widest mt-0.5">RENTAL PS</p>
                </div>
            </div>

            <div class="p-4 border-b border-white/10 bg-black/10">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-white/20 border-2 border-white/30 flex items-center justify-center font-bold text-white shadow-sm">
                        {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-sm font-bold text-white truncate">{{ Auth::user()->name ?? 'Admin' }}</p>
                        <div class="flex items-center gap-1 text-[10px] text-blue-200">
                            <span class="w-2 h-1 rounded-full bg-green-400"></span> Online
                        </div>
                    </div>
                </div>
            </div>

            <nav class="flex-1 px-3 py-6 space-y-1 overflow-y-auto flex flex-col">

                <p class="px-4 text-[10px] font-bold text-blue-300 uppercase tracking-wider mb-2 mt-2">Menu Utama</p>

                <a href="{{ route('home') }}" class="flex items-center px-4 py-3 rounded-lg transition-all {{ Request::is('/') ? 'bg-white text-brand-blue shadow-lg font-bold' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span>Homepage</span>
                </a>

                <a href="{{ route('rental') }}" class="flex items-center px-4 py-3 rounded-lg transition-all {{ Request::is('rental*') ? 'bg-white text-brand-blue shadow-lg font-bold' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    <span>Rental Area</span>
                </a>

                <a href="{{ route('fnb.cashier') }}" class="flex items-center px-4 py-3 rounded-lg transition-all {{ Request::is('fnb/order') ? 'bg-white text-brand-blue shadow-lg font-bold' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    <span>Order M&M</span>
                </a>

                <div class="h-3 w-full"></div>
                <p class="px-4 text-[10px] font-bold text-blue-300 uppercase tracking-wider mb-1">Manajemen</p>

                <a href="{{ route('fnb.index') }}" class="flex items-center px-4 py-3 rounded-lg transition-all {{ Request::routeIs('fnb.index') ? 'bg-white text-brand-blue shadow-lg font-bold' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    <span>Stok Gudang</span>
                </a>

                <a href="{{ route('members.index') }}" class="flex items-center px-4 py-3 rounded-lg transition-all {{ Request::routeIs('members*') ? 'bg-white text-brand-blue shadow-lg font-bold' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0c0 .854.546 1.597 1.332 1.882M15 20l-3-3m0 0l-3 3m3-3V10"></path></svg>
                    <span>Data Member</span>
                </a>

                <a href="{{ route('reports.index') }}" class="flex items-center px-4 py-3 rounded-lg transition-all {{ Request::is('reports*') ? 'bg-white text-brand-blue shadow-lg font-bold' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <span>Laporan & Riwayat</span>
                </a>

                <div class="mt-auto pt-6 pb-2 border-t border-white/10">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center px-4 py-3 text-red-300 hover:bg-red-500/20 hover:text-white rounded-lg transition-all font-semibold">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </nav>
        </aside>

        <main class="flex-1 flex flex-col h-screen overflow-hidden relative">
            <header class="h-20 bg-white flex justify-between items-center px-8 shadow-sm z-10 border-b border-gray-200 shrink-0">
                <h2 class="text-2xl font-black text-brand-dark">
                    @yield('judul_halaman')
                </h2>

                <div class="flex items-center gap-4">
                    @if(auth()->check() && auth()->user()->role === 'admin')
                        <select onchange="window.location.href=this.value" class="bg-blue-50 text-brand-blue border border-blue-200 rounded-lg py-2 px-4 focus:ring-2 focus:ring-brand-blue focus:outline-none cursor-pointer shadow-sm transition hover:bg-blue-100 font-bold text-sm">
                            <option value="{{ route('home') }}" selected>🖥️ Tampilan Manajemen</option>
                            <option value="{{ route('front') }}">🌐 Tampilan User</option>
                        </select>
                    @endif

                    @yield('header_actions')
                </div>
            </header>
            <div class="flex-1 overflow-y-auto p-6 md:p-8 bg-gray-100 scrollbar-hide">
                @yield('konten')
            </div>
        </main>
    </div>

    <div id="globalConfirmModal" class="fixed inset-0 bg-black/60 hidden flex items-center justify-center z-[99] backdrop-blur-sm p-4 transition-opacity duration-300">
        <div class="bg-white w-full max-w-sm rounded-2xl shadow-2xl border border-gray-200 transform scale-100 overflow-hidden">
            <div class="bg-red-50 p-6 flex flex-col items-center justify-center text-center border-b border-red-100">
                <div class="bg-red-100 p-3 rounded-full mb-3">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900" id="confirmTitle">Konfirmasi</h3>
                <p class="text-sm text-gray-500 mt-1 px-4" id="confirmMessage">Yakin ingin melakukan ini?</p>
            </div>
            <div class="p-4 flex gap-3 bg-gray-50">
                <button onclick="closeConfirmModal()" class="flex-1 py-2.5 bg-white border border-gray-300 text-gray-700 font-bold rounded-xl shadow-sm hover:bg-gray-100 transition">
                    Batal
                </button>
                <button id="confirmYesBtn" class="flex-1 py-2.5 bg-red-600 text-white font-bold rounded-xl shadow-md hover:bg-red-700 transition flex items-center justify-center gap-2">
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
            if (targetFormId) {
                document.getElementById(targetFormId).submit();
            }
            closeConfirmModal();
        });
    </script>
</body>
</html>
