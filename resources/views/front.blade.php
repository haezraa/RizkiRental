<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rizki Rental - Ketersediaan PS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans min-h-screen">

    <nav class="bg-blue-600 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">

                <div class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-10 mr-3 bg-white rounded-full p-1 shadow-sm">
                    <span class="font-bold text-xl tracking-wide uppercase">Rizki Rental</span>
                </div>

                <div class="flex items-center space-x-6">

                    @if(auth()->check() && auth()->user()->role === 'admin')
                        <div class="relative">
                            <select onchange="window.location.href=this.value" class="bg-white text-blue-700 border border-blue-400 rounded-md py-1.5 px-3 focus:outline-none focus:ring-2 focus:ring-blue-300 text-sm cursor-pointer font-bold shadow-sm">
                                <option value="{{ route('home') }}" selected>User Biasa</option>
                                <option value="{{ route('rental') }}">Manajemen</option>
                            </select>
                        </div>
                    @endif

                    <a href="#" class="hover:text-blue-200 transition duration-200 font-medium">About</a>

                    <form method="POST" action="{{ route('logout') }}" class="inline m-0">
                        @csrf
                        <button type="submit" class="hover:bg-blue-700 bg-blue-800 transition duration-200 font-medium text-sm px-4 py-2 rounded-md shadow">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="bg-white p-6 sm:p-8 rounded-xl shadow-sm border border-gray-200">

            <h2 class="text-2xl font-extrabold text-blue-900 border-b-[3px] border-blue-200 pb-3 mb-8 flex items-center">
                <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Status Ketersediaan PlayStation
            </h2>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">

                @foreach($consoles as $console)
                    <div class="bg-white border-2 {{ $console->status == 'ready' ? 'border-blue-400 shadow-blue-100' : 'border-red-400 shadow-red-100' }} rounded-2xl shadow-lg flex flex-col items-center relative overflow-hidden transition-transform duration-300 hover:-translate-y-1">

                        <div class="w-full h-3 {{ $console->status == 'ready' ? 'bg-blue-500' : 'bg-red-500' }}"></div>

                        <div class="p-5 flex flex-col items-center w-full">
                            <h3 class="text-xl font-black text-gray-800">{{ $console->name }}</h3>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">{{ $console->type }}</p>

                            <div class="mb-4 {{ $console->status == 'ready' ? 'text-blue-500' : 'text-red-500' }}">
                                <svg class="w-14 h-14" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 21m5.25-4l.75 4M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>

                            @if($console->status == 'ready')
                                <span class="bg-blue-50 text-blue-700 text-sm font-extrabold px-4 py-1.5 rounded-full uppercase w-full text-center border border-blue-200">
                                    Tersedia
                                </span>
                            @else
                                <span class="bg-red-50 text-red-700 text-sm font-extrabold px-4 py-1.5 rounded-full uppercase w-full text-center border border-red-200">
                                    Dipakai
                                </span>
                            @endif
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </main>

</body>
</html>
