@extends('parts.layout')

@section('judul_halaman', 'Rental Area')

@section('header_actions')
    <button onclick="openAddModal()"
        class="bg-brand-blue hover:bg-blue-800 text-white px-5 py-2.5 rounded-xl font-bold flex items-center gap-2 transition-all shadow-md shadow-blue-900/20 hover:shadow-lg hover:-translate-y-0.5 text-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
        </svg>
        Tambah Unit TV
    </button>
@endsection

@section('konten')

    @php
        $nowHour = \Carbon\Carbon::now('Asia/Jakarta')->hour;
        $isBegadangAllowed = ($nowHour >= 21 || $nowHour < 2);
    @endphp

    <div class="mb-10">
        <div class="flex items-center gap-3 mb-5">
            <div class="w-2 h-8 bg-brand-blue rounded-full"></div>
            <h3 class="text-xl font-extrabold text-slate-800 tracking-tight">PlayStation 3 Area</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @forelse($ps3_units as $unit)
                @include('parts.unit-card', ['unit' => $unit])
            @empty
                <div class="col-span-4 bg-slate-100 rounded-2xl border border-slate-200 border-dashed p-8 text-center">
                    <p class="text-slate-400 font-bold">Belum ada unit PS3.</p>
                </div>
            @endforelse
        </div>
    </div>

    <div class="mb-10">
        <div class="flex items-center gap-3 mb-5">
            <div class="w-2 h-8 bg-brand-blue rounded-full"></div>
            <h3 class="text-xl font-extrabold text-slate-800 tracking-tight">PlayStation 4 Area</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @forelse($ps4_units as $unit)
                @include('parts.unit-card', ['unit' => $unit])
            @empty
                <div class="col-span-4 bg-slate-100 rounded-2xl border border-slate-200 border-dashed p-8 text-center">
                    <p class="text-slate-400 font-bold">Belum ada unit PS4.</p>
                </div>
            @endforelse
        </div>
    </div>

    <div class="mb-10">
        <div class="flex items-center gap-3 mb-5">
            <div class="w-2 h-8 bg-brand-blue rounded-full"></div>
            <h3 class="text-xl font-extrabold text-slate-800 tracking-tight">PlayStation 5 Area</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @forelse($ps5_units as $unit)
                @include('parts.unit-card', ['unit' => $unit])
            @empty
                <div class="col-span-4 bg-slate-100 rounded-2xl border border-slate-200 border-dashed p-8 text-center">
                    <p class="text-slate-400 font-bold">Belum ada unit PS5.</p>
                </div>
            @endforelse
        </div>
    </div>

    <div id="bookingModal" class="fixed inset-0 bg-slate-900/60 hidden flex items-center justify-center z-50 backdrop-blur-sm p-4 transition-opacity duration-300">
        <div class="bg-white w-full max-w-md rounded-[2rem] shadow-2xl flex flex-col max-h-[85vh] overflow-hidden transform transition-all border border-slate-200">

            <div class="bg-gradient-to-r from-[#1e448e] to-[#153166] px-6 py-5 flex justify-between items-center flex-shrink-0 shadow-sm relative overflow-hidden">
                <div class="absolute right-0 top-0 w-24 h-24 bg-white/5 rounded-full blur-xl -mr-10 -mt-10"></div>
                <h3 class="text-lg font-extrabold text-white flex items-center gap-2 relative z-10">
                    <span>🎮</span> <span id="modalTitle">Booking TV</span>
                </h3>
                <button type="button" onclick="closeModal()" class="text-white/50 hover:text-white text-2xl leading-none transition relative z-10">&times;</button>
            </div>

            <div class="overflow-y-auto scrollbar-hide flex-1 bg-white relative">
                <form action="{{ route('booking.start') }}" method="POST" class="p-6 text-slate-800" id="bookingForm">
                    @csrf
                    <input type="hidden" name="console_id" id="modalConsoleId">
                    <input type="hidden" id="modalConsoleType">

                    <div class="mb-5">
                        <label class="block text-xs font-extrabold text-slate-500 uppercase mb-2 tracking-wider">Nama Player</label>
                        <input type="text" name="nama_pemain" id="inputNamaPemain"
                            class="w-full bg-slate-50 border border-slate-200 text-slate-800 font-bold rounded-xl p-3 focus:ring-2 focus:ring-brand-blue focus:border-brand-blue focus:outline-none transition-all shadow-sm"
                            required placeholder="Siapa yang main?">
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-5">
                        <div>
                            <label class="block text-xs font-extrabold text-slate-500 uppercase mb-2 tracking-wider">Durasi (Jam)</label>
                            <input type="number" name="durasi" id="inputDurasi" min="1" value="1" oninput="calculateTotal()"
                                class="w-full bg-slate-50 border border-slate-200 text-slate-800 font-bold rounded-xl p-3 focus:ring-2 focus:ring-brand-blue focus:border-brand-blue focus:outline-none transition-all shadow-sm">

                            <div class="mt-3 bg-blue-50/50 p-3 rounded-xl border border-blue-100">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <input type="checkbox" name="is_begadang" id="checkBegadang" onchange="toggleBegadang()" value="1"
                                            class="w-4 h-4 text-brand-blue bg-white border-slate-300 rounded focus:ring-brand-blue cursor-pointer disabled:opacity-50"
                                            {{ !$isBegadangAllowed ? 'disabled' : '' }}>
                                        <label for="checkBegadang" class="text-[11px] font-extrabold text-brand-blue uppercase cursor-pointer tracking-wider {{ !$isBegadangAllowed ? 'opacity-50' : '' }}">
                                            Paket Begadang
                                        </label>
                                    </div>
                                    @if(!$isBegadangAllowed)
                                        <span class="text-[9px] font-black text-rose-500 uppercase bg-rose-100 px-2 py-0.5 rounded-md">Tutup</span>
                                    @else
                                        <span class="text-[9px] font-black text-emerald-600 uppercase bg-emerald-100 px-2 py-0.5 rounded-md">Buka</span>
                                    @endif
                                </div>
                                @if(!$isBegadangAllowed)
                                    <p class="text-[9px] text-rose-500 font-bold mt-2 leading-tight">*Order khusus jam 21:00 - 02:00.</p>
                                @endif
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-extrabold text-slate-500 uppercase mb-2 tracking-wider">Makan / Minum</label>
                            <div class="bg-slate-50 border border-slate-200 rounded-xl p-2 h-[155px] overflow-y-auto scrollbar-hide space-y-2 shadow-inner">
                                @forelse($products as $item)
                                    <div class="flex items-center justify-between bg-white p-2.5 rounded-lg border border-slate-100 shadow-sm hover:border-blue-200 transition-colors">
                                        <div class="flex-1">
                                            <p class="text-xs font-extrabold text-slate-700 truncate w-16">{{ $item->name }}</p>
                                            <p class="text-[10px] text-slate-400 font-semibold">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                        </div>
                                        <input type="number" name="qty[{{ $item->id }}]" data-price="{{ $item->price }}" oninput="calculateTotal()" min="0" max="{{ $item->stock }}"
                                            class="fnb-qty w-12 h-8 text-center border border-slate-200 rounded-md text-sm font-bold text-brand-blue focus:ring-2 focus:ring-brand-blue focus:outline-none"
                                            placeholder="0">
                                    </div>
                                @empty
                                    <div class="flex flex-col items-center justify-center h-full text-slate-400 text-xs font-bold italic">
                                        <span>Menu Kosong</span>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="mb-6 bg-gradient-to-r from-blue-50 to-slate-50 border border-blue-100 p-5 rounded-2xl flex justify-between items-center shadow-sm">
                        <div>
                            <p class="text-xs text-blue-500 font-extrabold uppercase tracking-widest">Total Bayar :</p>
                        </div>
                        <div class="text-right">
                            <h3 class="text-2xl font-black text-brand-blue tracking-tight" id="liveTotalDisplay">Rp 0</h3>
                        </div>
                    </div>

                    <div class="mb-4 border-t border-slate-100 pt-5">
                        <label class="block text-xs font-extrabold text-slate-500 uppercase mb-3 tracking-wider">Metode Pembayaran</label>

                        <div class="grid grid-cols-2 gap-3 mb-3">
                            <label class="cursor-pointer relative group">
                                <input type="radio" name="payment_method" value="cash" class="peer sr-only" checked onchange="toggleQris(false)">
                                <div class="p-3.5 rounded-xl border-2 border-slate-200 text-slate-500 peer-checked:border-brand-blue peer-checked:bg-blue-50 peer-checked:text-brand-blue font-extrabold text-sm text-center transition-all flex items-center justify-center gap-2 group-hover:bg-slate-50">
                                    <span>💵</span> Tunai
                                </div>
                            </label>
                            <label class="cursor-pointer relative group">
                                <input type="radio" name="payment_method" value="qris" class="peer sr-only" onchange="toggleQris(true)">
                                <div class="p-3.5 rounded-xl border-2 border-slate-200 text-slate-500 peer-checked:border-brand-blue peer-checked:bg-blue-50 peer-checked:text-brand-blue font-extrabold text-sm text-center transition-all flex items-center justify-center gap-2 group-hover:bg-slate-50">
                                    <span>📱</span> QRIS
                                </div>
                            </label>
                        </div>

                        <div id="qrisArea" class="hidden overflow-hidden transition-all duration-300 ease-in-out">
                            <div class="bg-slate-50 border-2 border-dashed border-slate-300 rounded-xl p-4 flex items-center gap-4 animate-in fade-in slide-in-from-top-2">
                                <div class="bg-white p-1.5 rounded-lg border border-slate-200 shadow-sm flex-shrink-0">
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=ContohQRISRentalPS" class="w-16 h-16" alt="QRIS">
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-extrabold text-slate-800">Scan QRIS</p>
                                    <p class="text-[10px] text-slate-500 mt-1 font-semibold leading-relaxed">
                                        Cek mutasi sebelum klik tombol Start. <br>
                                        <span class="text-brand-blue font-bold">Otomatis masuk sistem.</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <button type="submit" class="w-full bg-brand-blue hover:bg-blue-800 text-white py-4 rounded-xl font-extrabold text-base shadow-lg shadow-blue-900/20 hover:shadow-xl transition-all transform hover:-translate-y-0.5 flex items-center justify-center gap-2 tracking-wide">
                            START GAME
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="addUnitModal" class="fixed inset-0 bg-slate-900/60 hidden flex items-center justify-center z-50 backdrop-blur-sm p-4 transition-opacity duration-300">
        <div class="bg-white w-full max-w-md rounded-[2rem] shadow-2xl overflow-hidden border border-slate-200 transform transition-all">

            <div class="bg-gradient-to-r from-[#1e448e] to-[#153166] px-6 py-5 flex justify-between items-center relative overflow-hidden">
                <div class="absolute right-0 top-0 w-24 h-24 bg-white/5 rounded-full blur-xl -mr-10 -mt-10"></div>
                <h3 class="text-lg font-extrabold text-white flex items-center gap-2 relative z-10">
                    <span>📺</span> <span>Tambah Unit Baru</span>
                </h3>
                <button type="button" onclick="closeAddModal()" class="text-white/50 hover:text-white text-2xl leading-none relative z-10">&times;</button>
            </div>

            <form action="{{ route('consoles.store') }}" method="POST" class="p-6 text-slate-800">
                @csrf
                <div class="mb-5">
                    <label class="block text-xs font-extrabold text-slate-500 uppercase mb-2 tracking-wider">Nama Unit</label>
                    <input type="text" name="nama_unit" class="w-full bg-slate-50 border border-slate-200 text-slate-900 font-bold rounded-xl p-3 focus:ring-2 focus:ring-brand-blue focus:outline-none placeholder-slate-400 shadow-sm" required placeholder="Contoh: TV 05">
                </div>

                <div class="mb-8">
                    <label class="block text-xs font-extrabold text-slate-500 uppercase mb-3 tracking-wider">Jenis Konsol</label>
                    <div class="grid grid-cols-3 gap-3">
                        <label class="cursor-pointer relative">
                            <input type="radio" name="tipe_ps" value="PS3" class="peer sr-only" required>
                            <div class="p-3 rounded-xl border-2 border-slate-200 text-slate-500 peer-checked:border-brand-blue peer-checked:bg-blue-50 peer-checked:text-brand-blue font-extrabold text-sm text-center transition-all hover:bg-slate-50 shadow-sm">PS 3</div>
                        </label>
                        <label class="cursor-pointer relative">
                            <input type="radio" name="tipe_ps" value="PS4" class="peer sr-only">
                            <div class="p-3 rounded-xl border-2 border-slate-200 text-slate-500 peer-checked:border-brand-blue peer-checked:bg-blue-50 peer-checked:text-brand-blue font-extrabold text-sm text-center transition-all hover:bg-slate-50 shadow-sm">PS 4</div>
                        </label>
                        <label class="cursor-pointer relative">
                            <input type="radio" name="tipe_ps" value="PS5" class="peer sr-only">
                            <div class="p-3 rounded-xl border-2 border-slate-200 text-slate-500 peer-checked:border-brand-blue peer-checked:bg-blue-50 peer-checked:text-brand-blue font-extrabold text-sm text-center transition-all hover:bg-slate-50 shadow-sm">PS 5</div>
                        </label>
                    </div>
                </div>

                <button type="submit" class="w-full bg-brand-blue hover:bg-blue-800 text-white py-4 rounded-xl font-extrabold text-base shadow-lg shadow-blue-900/20 hover:shadow-xl transition transform hover:-translate-y-0.5 tracking-wide">
                    SIMPAN UNIT
                </button>
            </form>
        </div>
    </div>

    <script>
        function openModal(name, type, id) {
            const modal = document.getElementById('bookingModal');
            modal.classList.remove('hidden');

            document.getElementById('modalTitle').innerText = name + ' (' + type + ')';
            document.getElementById('modalConsoleId').value = id;
            document.getElementById('modalConsoleType').value = type;

            document.getElementById('bookingForm').reset();
            document.getElementById('qrisArea').classList.add('hidden');

            document.getElementById('inputNamaPemain').readOnly = false;
            document.getElementById('inputNamaPemain').value = "";

            const checkBegadang = document.getElementById('checkBegadang');
            if(checkBegadang && !checkBegadang.disabled) {
                checkBegadang.checked = false;
            }
            toggleBegadang();

            calculateTotal();
        }

        function closeModal() {
            document.getElementById('bookingModal').classList.add('hidden');
        }

        function toggleBegadang() {
            const checkBegadang = document.getElementById('checkBegadang');
            if(!checkBegadang) return;

            const isBegadang = checkBegadang.checked;
            const inputDurasi = document.getElementById('inputDurasi');

            if(isBegadang) {
                inputDurasi.dataset.oldValue = inputDurasi.value;
                inputDurasi.type = 'text';
                inputDurasi.value = "S/D 06:00 Pagi";
                inputDurasi.readOnly = true;
                inputDurasi.classList.add('opacity-50', 'bg-slate-200', 'text-xs');
            } else {
                inputDurasi.type = 'number';
                inputDurasi.value = inputDurasi.dataset.oldValue || 1;
                inputDurasi.readOnly = false;
                inputDurasi.classList.remove('opacity-50', 'bg-slate-200', 'text-xs');
            }
            calculateTotal();
        }

        function calculateTotal() {
            let type = document.getElementById('modalConsoleType').value;
            let checkBegadang = document.getElementById('checkBegadang');
            let isBegadang = checkBegadang ? checkBegadang.checked : false;

            let pricePerHour = 0;
            let priceBegadang = 0;

            if (type === 'PS3') {
                pricePerHour = 5000;
                priceBegadang = 40000;
            } else if (type === 'PS4') {
                pricePerHour = 7000;
                priceBegadang = 80000;
            } else if (type === 'PS5') {
                pricePerHour = 12000;
                priceBegadang = 150000;
            }

            let rentalTotal = 0;
            if(isBegadang) {
                rentalTotal = priceBegadang;
            } else {
                let duration = parseInt(document.getElementById('inputDurasi').value) || 0;
                rentalTotal = pricePerHour * duration;
            }

            let fnbTotal = 0;
            let fnbInputs = document.querySelectorAll('.fnb-qty');
            fnbInputs.forEach(input => {
                let qty = parseInt(input.value) || 0;
                let price = parseInt(input.getAttribute('data-price')) || 0;
                fnbTotal += (qty * price);
            });

            let grandTotal = rentalTotal + fnbTotal;
            let formatted = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(grandTotal);

            document.getElementById('liveTotalDisplay').innerText = formatted;
        }

        function toggleQris(show) {
            const qrisArea = document.getElementById('qrisArea');
            if (show) {
                qrisArea.classList.remove('hidden');
            } else {
                qrisArea.classList.add('hidden');
            }
        }

        function openAddModal() {
            document.getElementById('addUnitModal').classList.remove('hidden');
        }

        function closeAddModal() {
            document.getElementById('addUnitModal').classList.add('hidden');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const timers = document.querySelectorAll('.countdown-timer');

            timers.forEach(timer => {
                const endTime = new Date(timer.dataset.end).getTime();

                const interval = setInterval(() => {
                    const now = new Date().getTime();
                    const distance = endTime - now;

                    if (distance < 0) {
                        clearInterval(interval);
                        timer.innerHTML = "SELESAI";
                        location.reload();
                    } else {
                        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                        timer.innerHTML =
                            (hours < 10 ? "0" + hours : hours) + ":" +
                            (minutes < 10 ? "0" + minutes : minutes) + ":" +
                            (seconds < 10 ? "0" + seconds : seconds);
                    }
                }, 1000);
            });
        });
    </script>
@endsection
