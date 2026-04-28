@extends('parts.layoutuser')

@section('judul_halaman', 'Top Up Waktu - Rizki Rental')

@section('konten')
    <div class="max-w-[750px] mx-auto px-6 py-12">

        <div class="text-center mb-10">
            <h2 class="text-3xl md:text-4xl font-black text-slate-800 tracking-tight">Hi, <span class="text-[#2251a5]">{{ explode(' ', $user->name)[0] }}!</span></h2>
            <p class="text-slate-500 mt-2 font-medium text-base">Isi dompet waktu kamu dan langsung gaskeun mabar tanpa ribet antri kasir.</p>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden mb-8">
            <div class="bg-slate-50 px-6 py-4 border-b border-slate-100 flex justify-between items-center">
                <h3 class="text-sm font-black text-slate-700 uppercase tracking-wider">
                    Dompet Waktu Kamu
                </h3>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-3 gap-4">
                    <div class="bg-white border border-slate-200 rounded-2xl p-4 text-center shadow-sm">
                        <div class="text-[11px] font-extrabold text-slate-400 mb-1 uppercase tracking-widest">Saldo PS 3</div>
                        <div class="text-2xl font-black text-slate-800">{{ floor($user->saldo_ps3/60) }}<span class="text-sm text-slate-400 ml-0.5 mr-1">j</span>{{ $user->saldo_ps3%60 }}<span class="text-sm text-slate-400 ml-0.5">m</span></div>
                    </div>
                    <div class="bg-white border border-slate-200 rounded-2xl p-4 text-center shadow-sm">
                        <div class="text-[11px] font-extrabold text-slate-400 mb-1 uppercase tracking-widest">Saldo PS 4</div>
                        <div class="text-2xl font-black text-[#2251a5]">{{ floor($user->saldo_ps4/60) }}<span class="text-sm text-blue-300 ml-0.5 mr-1">j</span>{{ $user->saldo_ps4%60 }}<span class="text-sm text-blue-300 ml-0.5">m</span></div>
                    </div>
                    <div class="bg-white border border-slate-200 rounded-2xl p-4 text-center shadow-sm">
                        <div class="text-[11px] font-extrabold text-slate-400 mb-1 uppercase tracking-widest">Saldo PS 5</div>
                        <div class="text-2xl font-black text-slate-800">{{ floor($user->saldo_ps5/60) }}<span class="text-sm text-slate-400 ml-0.5 mr-1">j</span>{{ $user->saldo_ps5%60 }}<span class="text-sm text-slate-400 ml-0.5">m</span></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden mb-10">
            <div class="bg-slate-50 px-6 py-4 border-b border-slate-100">
                <h3 class="text-sm font-black text-slate-700 uppercase tracking-wider">
                    Beli Paket Waktu
                </h3>
            </div>

            <form action="{{ route('user.topup.store') }}" method="POST" class="p-6 md:p-8">
                @csrf

                <div class="mb-8">
                    <label class="block text-sm font-black text-slate-700 mb-3">Pilih Konsol <span class="text-red-500">*</span></label>
                    <div class="grid grid-cols-3 gap-3 md:gap-4">
                        <label class="cursor-pointer relative group">
                            <input type="radio" name="tipe_ps" value="PS3" data-price="5000" class="peer sr-only" required onchange="hitungTotal()">
                            <div class="p-4 rounded-xl border-2 border-slate-200 text-slate-500 peer-checked:border-[#2251a5] peer-checked:bg-blue-50 peer-checked:text-[#2251a5] font-black text-center transition-all">
                                <div class="text-base">PS 3</div>
                                <div class="text-[10px] font-bold mt-0.5 text-slate-400 peer-checked:text-blue-400">Rp 5.000/jam</div>
                            </div>
                        </label>

                        <label class="cursor-pointer relative group">
                            <input type="radio" name="tipe_ps" value="PS4" data-price="10000" class="peer sr-only" onchange="hitungTotal()">
                            <div class="p-4 rounded-xl border-2 border-slate-200 text-slate-500 peer-checked:border-[#2251a5] peer-checked:bg-blue-50 peer-checked:text-[#2251a5] font-black text-center transition-all">
                                <div class="text-base">PS 4</div>
                                <div class="text-[10px] font-bold mt-0.5 text-slate-400 peer-checked:text-blue-400">Rp 10.000/jam</div>
                            </div>
                        </label>

                        <label class="cursor-pointer relative group">
                            <input type="radio" name="tipe_ps" value="PS5" data-price="20000" class="peer sr-only" onchange="hitungTotal()">
                            <div class="p-4 rounded-xl border-2 border-slate-200 text-slate-500 peer-checked:border-[#2251a5] peer-checked:bg-blue-50 peer-checked:text-[#2251a5] font-black text-center transition-all">
                                <div class="text-base">PS 5</div>
                                <div class="text-[10px] font-bold mt-0.5 text-slate-400 peer-checked:text-blue-400">Rp 20.000/jam</div>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="mb-10">
                    <label class="block text-sm font-black text-slate-700 mb-3">Mau Beli Berapa Jam? <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <select name="durasi_jam" id="durasi_jam" class="w-full bg-slate-50 border-2 border-slate-200 text-slate-700 text-base font-bold rounded-xl focus:ring-0 focus:border-[#2251a5] block px-4 py-3.5 appearance-none cursor-pointer hover:bg-white transition-colors" required onchange="hitungTotal()">
                            <option value="" disabled selected>Pilih durasi main...</option>
                            <option value="1">1 Jam</option>
                            <option value="2">2 Jam</option>
                            <option value="3">3 Jam</option>
                            <option value="4">4 Jam</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>

                <div class="bg-blue-50/50 p-5 rounded-xl border border-blue-100 mb-6 flex justify-between items-center">
                    <div>
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-1">Total Pembayaran</p>
                        <p class="text-3xl font-black text-[#2251a5]" id="teksTotalHarga">Rp 0</p>
                    </div>
                    <div class="hidden sm:block text-right">
                        <p class="text-xs font-bold text-slate-400" id="teksRincian">-</p>
                    </div>
                </div>

                <button type="submit" class="w-full py-4 bg-[#2251a5] text-white font-black text-lg rounded-xl hover:bg-blue-800 transition shadow-md hover:shadow-lg hover:-translate-y-0.5 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    BAYAR SEKARANG
                </button>
            </form>
        </div>

        <div class="bg-white rounded-3xl p-6 md:p-8 border border-slate-200 shadow-sm">
            <h3 class="text-sm font-black text-slate-700 uppercase tracking-widest mb-6">Cara Main</h3>

            <div class="space-y-5">
                <div class="flex gap-4 items-start">
                    <div class="w-8 h-8 rounded-full bg-blue-50 text-[#2251a5] font-black flex items-center justify-center flex-shrink-0 text-sm">1</div>
                    <div>
                        <h4 class="font-bold text-slate-800 text-sm">Top Up Waktu</h4>
                        <p class="text-sm text-slate-500 mt-0.5">Pilih konsol dan durasi jam di atas. Saldo akan otomatis masuk ke dompet digital kamu.</p>
                    </div>
                </div>
                <div class="flex gap-4 items-start">
                    <div class="w-8 h-8 rounded-full bg-blue-50 text-[#2251a5] font-black flex items-center justify-center flex-shrink-0 text-sm">2</div>
                    <div>
                        <h4 class="font-bold text-slate-800 text-sm">Pilih TV Ready</h4>
                        <p class="text-sm text-slate-500 mt-0.5">Kembali ke halaman utama, cari TV yang statusnya hijau (READY), lalu klik.</p>
                    </div>
                </div>
                <div class="flex gap-4 items-start">
                    <div class="w-8 h-8 rounded-full bg-blue-50 text-[#2251a5] font-black flex items-center justify-center flex-shrink-0 text-sm">3</div>
                    <div>
                        <h4 class="font-bold text-slate-800 text-sm">Gas Mabar</h4>
                        <p class="text-sm text-slate-500 mt-0.5">Konfirmasi booking. Waktu dompetmu otomatis terpotong dan TV siap digunakan!</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@stack('scripts')
<script>
    function hitungTotal() {
        const konsolDipilih = document.querySelector('input[name="tipe_ps"]:checked');
        const jamDipilih = document.getElementById('durasi_jam').value;

        const teksTotal = document.getElementById('teksTotalHarga');
        const teksRincian = document.getElementById('teksRincian');

        if (konsolDipilih && jamDipilih) {
            const hargaPerJam = parseInt(konsolDipilih.getAttribute('data-price'));
            const jumlahJam = parseInt(jamDipilih);
            const namaKonsol = konsolDipilih.value;

            const totalMurni = hargaPerJam * jumlahJam;

            const rupiahFormat = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(totalMurni);

            teksTotal.innerText = rupiahFormat;
            teksRincian.innerText = `${namaKonsol} (${jumlahJam} Jam)`;
        } else {
            teksTotal.innerText = 'Rp 0';
            teksRincian.innerText = '-';
        }
    }
</script>
