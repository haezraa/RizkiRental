@extends('layouts.main')

@section('judul_halaman', 'Rental Area')

@section('header_actions')
    <button onclick="openAddModal()"
        class="bg-[#2251a5] hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-bold flex items-center gap-2 transition shadow-md hover:shadow-lg hover:-translate-y-0.5">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Tambah Unit TV
    </button>
@endsection

@section('konten')

    <div class="mb-10">
        <h3 class="text-xl font-bold mb-4 border-l-4 border-brand-blue pl-3 text-gray-800">PlayStation 3 Area</h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            @forelse($ps3_units as $unit)
                @include('components.unit-card', ['unit' => $unit])
            @empty
                <p class="text-gray-500 italic col-span-4">Belum ada unit PS3.</p>
            @endforelse
        </div>
    </div>

    <div class="mb-10">
        <h3 class="text-xl font-bold mb-4 border-l-4 border-brand-blue pl-3 text-gray-800">PlayStation 4 Area</h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            @forelse($ps4_units as $unit)
                @include('components.unit-card', ['unit' => $unit])
            @empty
                <p class="text-gray-500 italic col-span-4">Belum ada unit PS4.</p>
            @endforelse
        </div>
    </div>

    <div class="mb-10">
        <h3 class="text-xl font-bold mb-4 border-l-4 border-brand-blue pl-3 text-gray-800">PlayStation 5 Area</h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            @forelse($ps5_units as $unit)
                @include('components.unit-card', ['unit' => $unit])
            @empty
                <p class="text-gray-500 italic col-span-4">Belum ada unit PS5.</p>
            @endforelse
        </div>
    </div>

    <div id="bookingModal"
        class="fixed inset-0 bg-black/60 hidden flex items-center justify-center z-50 backdrop-blur-sm p-4 transition-opacity duration-300">

        <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl border border-gray-200 flex flex-col max-h-[85vh] overflow-hidden transform transition-all scale-100">

            <div class="bg-[#2251a5] px-6 py-4 flex justify-between items-center flex-shrink-0 z-20 shadow-md">
                <h3 class="text-lg font-bold text-white flex items-center gap-2">
                    <span>🎮</span> <span id="modalTitle">Booking TV</span>
                </h3>
                <button onclick="closeModal()" class="text-white/70 hover:text-white text-2xl leading-none transition">&times;</button>
            </div>

            <div class="overflow-y-auto scrollbar-hide flex-1 bg-white relative">

                <form action="{{ route('booking.start') }}" method="POST" class="p-6 text-gray-800" id="bookingForm">
                    @csrf
                    <input type="hidden" name="console_id" id="modalConsoleId">
                    <input type="hidden" id="modalConsoleType">

                    <div class="mb-4">
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nama Player</label>
                        <input type="text" name="nama_pemain" id="inputNamaPemain"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 font-semibold rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                            required placeholder="Siapa yang main?">
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Durasi (Jam)</label>
                            <input type="number" name="durasi" id="inputDurasi" min="1" value="1"
                                oninput="calculateTotal()"
                                class="w-full bg-gray-50 border border-gray-300 text-gray-900 font-semibold rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Pesan Makan / Minum</label>
                            <div class="bg-gray-50 border border-gray-300 rounded-lg p-2 h-[150px] overflow-y-auto scrollbar-hide space-y-2">
                                @forelse($products as $item)
                                    <div class="flex items-center justify-between bg-white p-2 rounded border border-gray-100 shadow-sm hover:border-blue-200 transition">
                                        <div class="flex-1">
                                            <p class="text-xs font-bold text-gray-700 truncate w-20">{{ $item->name }}</p>
                                            <p class="text-[10px] text-gray-400">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                        </div>
                                        <input type="number" name="qty[{{ $item->id }}]"
                                            data-price="{{ $item->price }}" oninput="calculateTotal()" min="0"
                                            max="{{ $item->stock }}"
                                            class="fnb-qty w-10 h-8 text-center border border-gray-200 rounded text-sm focus:ring-1 focus:ring-blue-500 focus:outline-none"
                                            placeholder="0">
                                    </div>
                                @empty
                                    <div class="flex flex-col items-center justify-center h-full text-gray-400 text-[10px] italic">
                                        <span>Menu Kosong</span>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="mb-6 bg-gradient-to-r from-blue-50 to-white border border-blue-100 p-4 rounded-xl flex justify-between items-center shadow-sm">
                        <div>
                            <p class="text-base text-blue-500 mt-1 font-bold uppercase tracking-wider">Total Bayar : </p>
                        </div>
                        <div class="text-right">
                            <h3 class="text-3xl font-black text-blue-600 tracking-tight" id="liveTotalDisplay">Rp 0</h3>
                        </div>
                    </div>

                    <div class="mb-2 border-t border-gray-100 pt-4">
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Metode Pembayaran</label>

                        <div class="grid grid-cols-2 gap-3 mb-3">
                            <label class="cursor-pointer relative group">
                                <input type="radio" name="payment_method" value="cash" class="peer sr-only" checked onchange="toggleQris(false)">
                                <div class="p-3 rounded-lg border-2 border-gray-200 text-gray-500 peer-checked:border-blue-600 peer-checked:bg-blue-50 peer-checked:text-blue-700 font-bold text-center transition-all flex items-center justify-center gap-2 group-hover:bg-gray-50">
                                    <span>💵</span> Tunai
                                </div>
                            </label>
                            <label class="cursor-pointer relative group">
                                <input type="radio" name="payment_method" value="qris" class="peer sr-only" onchange="toggleQris(true)">
                                <div class="p-3 rounded-lg border-2 border-gray-200 text-gray-500 peer-checked:border-blue-600 peer-checked:bg-blue-50 peer-checked:text-blue-700 font-bold text-center transition-all flex items-center justify-center gap-2 group-hover:bg-gray-50">
                                    <span>📱</span> QRIS
                                </div>
                            </label>
                        </div>

                        <div id="qrisArea" class="hidden overflow-hidden transition-all duration-300 ease-in-out">
                            <div class="bg-gray-50 border-2 border-dashed border-gray-300 rounded-lg p-3 flex items-center gap-4 animate-in fade-in slide-in-from-top-2">
                                <div class="bg-white p-1 rounded border border-gray-200 shadow-sm flex-shrink-0">
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=ContohQRISRentalPS" class="w-20 h-20" alt="QRIS">
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-bold text-gray-800">Scan QRIS</p>
                                    <p class="text-[10px] text-gray-500 mt-1 leading-relaxed">
                                        Cek mutasi sebelum klik tombol Start. <br>
                                        <span class="text-blue-600 font-semibold">Otomatis masuk sistem.</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="w-full bg-[#2251a5] hover:bg-blue-800 text-white py-3.5 rounded-xl font-bold text-lg shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                         START GAME
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="addUnitModal" class="fixed inset-0 bg-black/60 hidden flex items-center justify-center z-50 backdrop-blur-sm p-4">
        <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl overflow-hidden border border-gray-200 transform transition-all">

            <div class="bg-[#2251a5] px-6 py-4 flex justify-between items-center">
                <h3 class="text-lg font-bold text-white flex items-center gap-2">
                    <span>📺</span> <span>Tambah Unit Baru</span>
                </h3>
                <button onclick="closeAddModal()" class="text-white/70 hover:text-white text-2xl leading-none">&times;</button>
            </div>

            <form action="{{ route('consoles.store') }}" method="POST" class="p-6 text-gray-800">
                @csrf
                <div class="mb-4">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nama Unit</label>
                    <input type="text" name="nama_unit" class="w-full bg-gray-50 border border-gray-300 text-gray-900 font-semibold rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 focus:outline-none placeholder-gray-400" required placeholder="Contoh: TV 05">
                </div>

                <div class="mb-6">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Jenis Konsol</label>
                    <div class="grid grid-cols-3 gap-3">
                        <label class="cursor-pointer relative">
                            <input type="radio" name="tipe_ps" value="PS3" class="peer sr-only" required>
                            <div class="p-3 rounded-lg border-2 border-gray-200 text-gray-500 peer-checked:border-blue-600 peer-checked:bg-blue-50 peer-checked:text-blue-700 font-bold text-center transition-all hover:bg-gray-50">PS 3</div>
                        </label>
                        <label class="cursor-pointer relative">
                            <input type="radio" name="tipe_ps" value="PS4" class="peer sr-only">
                            <div class="p-3 rounded-lg border-2 border-gray-200 text-gray-500 peer-checked:border-blue-600 peer-checked:bg-blue-50 peer-checked:text-blue-700 font-bold text-center transition-all hover:bg-gray-50">PS 4</div>
                        </label>
                        <label class="cursor-pointer relative">
                            <input type="radio" name="tipe_ps" value="PS5" class="peer sr-only">
                            <div class="p-3 rounded-lg border-2 border-gray-200 text-gray-500 peer-checked:border-blue-600 peer-checked:bg-blue-50 peer-checked:text-blue-700 font-bold text-center transition-all hover:bg-gray-50">PS 5</div>
                        </label>
                    </div>
                </div>

                <button type="submit" class="w-full bg-[#2251a5] hover:bg-blue-800 text-white py-3.5 rounded-xl font-bold text-lg shadow-lg hover:shadow-xl transition transform hover:-translate-y-0.5">
                    SIMPAN UNIT
                </button>
            </form>
        </div>
    </div>

    <script>
        // 1. SETUP LOGIC MODAL BOOKING
        function openModal(name, type, id) {
            const modal = document.getElementById('bookingModal');
            modal.classList.remove('hidden');

            // Set Data ke Input Hidden
            document.getElementById('modalTitle').innerText = name + ' (' + type + ')';
            document.getElementById('modalConsoleId').value = id;
            document.getElementById('modalConsoleType').value = type;

            // Reset Form & UI
            document.getElementById('bookingForm').reset();
            document.getElementById('qrisArea').classList.add('hidden'); // Sembunyiin QRIS

            // Reset Nama
            document.getElementById('inputNamaPemain').readOnly = false;
            document.getElementById('inputNamaPemain').value = "";

            // Trigger hitung total awal (1 jam)
            calculateTotal();
        }

        function closeModal() {
            document.getElementById('bookingModal').classList.add('hidden');
        }

        // 2. LOGIC MENGHITUNG TOTAL HARGA
        function calculateTotal() {
            let type = document.getElementById('modalConsoleType').value;
            let pricePerHour = 0;

            if (type === 'PS3') {
                pricePerHour = 5000;
            } else if (type === 'PS4') {
                pricePerHour = 7000;
            } else if (type === 'PS5') {
                pricePerHour = 12000;
            }

            // Hitung Rental
            let duration = parseInt(document.getElementById('inputDurasi').value) || 0;
            let rentalTotal = pricePerHour * duration;

            // Hitung menu fnb
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
