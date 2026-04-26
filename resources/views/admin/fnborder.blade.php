@extends('parts.layout')

@section('judul_halaman', 'Kasir Makanan & Minuman')

@section('konten')
    <div class="flex flex-col lg:flex-row gap-6 h-[calc(100vh-140px)]">

        <div class="flex-1 bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden flex flex-col">

            <div class="p-5 border-b border-slate-100 bg-white/90 backdrop-blur-md z-10 sticky top-0">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" id="searchMenu" placeholder="Cari menu makanan atau minuman..."
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-11 pr-4 py-3 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-brand-blue focus:border-brand-blue focus:outline-none transition-all shadow-sm">
                </div>
            </div>

            <div class="flex-1 overflow-y-auto p-6 bg-slate-50 scrollbar-hide space-y-10">

                <div>
                    <div class="flex items-center gap-3 mb-5 border-b border-slate-200/60 pb-3">
                        <div class="w-2 h-6 bg-brand-blue rounded-full"></div>
                        <h3 class="text-xl font-extrabold text-slate-800 tracking-tight flex items-center gap-2">
                            <span>🍜</span> Menu Makanan
                        </h3>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-5">
                        @forelse($products->where('category', 'makanan') as $item)
                            @include('parts.menu-card', ['item' => $item])
                        @empty
                            <div class="col-span-full bg-white rounded-2xl border border-slate-200 border-dashed p-8 text-center shadow-sm">
                                <p class="text-slate-400 font-bold">Belum ada menu makanan.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div>
                    <div class="flex items-center gap-3 mb-5 border-b border-slate-200/60 pb-3">
                        <div class="w-2 h-6 bg-brand-blue rounded-full"></div>
                        <h3 class="text-xl font-extrabold text-slate-800 tracking-tight flex items-center gap-2">
                            <span>🥤</span> Menu Minuman
                        </h3>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-5">
                        @forelse($products->where('category', 'minuman') as $item)
                            @include('parts.menu-card', ['item' => $item])
                        @empty
                            <div class="col-span-full bg-white rounded-2xl border border-slate-200 border-dashed p-8 text-center shadow-sm">
                                <p class="text-slate-400 font-bold">Belum ada menu minuman.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>

        <div class="w-full lg:w-[400px] bg-white rounded-3xl shadow-xl shadow-blue-900/5 border border-slate-200 flex flex-col h-full overflow-hidden flex-shrink-0">

            <div class="bg-gradient-to-r from-[#1e448e] to-[#153166] p-5 relative overflow-hidden flex-shrink-0">
                <div class="absolute right-0 top-0 w-24 h-24 bg-white/5 rounded-full blur-xl -mr-10 -mt-10"></div>
                <h3 class="font-extrabold text-lg text-white flex items-center gap-2 relative z-10 tracking-wide">
                    🛒 Pesanan Baru
                </h3>
            </div>

            <form action="{{ route('booking.addOrder') }}" method="POST" id="orderForm" class="flex-1 flex flex-col overflow-hidden bg-slate-50/50">
                @csrf

                <div class="p-5 border-b border-slate-100 relative" id="playerDropdownWrapper">
                    <label class="block text-xs font-extrabold text-slate-500 uppercase mb-2 tracking-wider">Kirim Ke Player:</label>

                    <input type="hidden" name="console_id" id="selectedConsoleId">

                    <button type="button" onclick="togglePlayerDropdown()" id="playerDropdownBtn"
                        class="w-full flex items-center justify-between bg-white border border-slate-200 rounded-xl p-3 font-bold text-slate-400 hover:bg-slate-50 focus:ring-2 focus:ring-brand-blue focus:border-brand-blue shadow-sm outline-none transition-all">
                        <span id="playerDropdownText" class="truncate pr-2">Pilih Player Aktif...</span>
                        <svg class="w-5 h-5 text-slate-400 transition-transform duration-200 flex-shrink-0" id="playerDropdownIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>

                    <div id="playerDropdownMenu" class="absolute left-5 right-5 top-[85px] bg-white rounded-xl shadow-[0_10px_25px_-5px_rgba(0,0,0,0.1)] border border-slate-100 opacity-0 invisible scale-95 origin-top transition-all duration-200 z-50 max-h-56 overflow-y-auto scrollbar-hide">
                        <div class="p-1.5 flex flex-col gap-0.5">
                            @forelse($active_consoles as $console)
                                @php
                                    $playerName = $console->activeTransaction ? Str::limit($console->activeTransaction->customer_name, 15) : 'Unknown';
                                    $displayText = $console->name . ' (' . $playerName . ')';
                                @endphp
                                <button type="button" onclick="selectPlayer('{{ $console->id }}', '{{ $displayText }}')"
                                    class="w-full text-left px-3 py-2.5 text-sm font-bold text-slate-700 hover:bg-blue-50 hover:text-brand-blue rounded-lg transition-colors flex items-center gap-2 group">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 shadow-[0_0_5px_rgba(52,211,153,0.5)] group-hover:scale-125 transition-transform"></span>
                                    <span class="truncate">{{ $displayText }}</span>
                                </button>
                            @empty
                                <div class="px-3 py-4 text-sm font-semibold text-slate-400 text-center italic">
                                    🚫 Tidak ada player aktif saat ini
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="flex-1 overflow-y-auto p-5 scrollbar-hide" id="cartContainer">
                    <div class="flex flex-col items-center justify-center h-full text-slate-400 text-sm italic font-semibold" id="emptyCartText">
                        <svg class="w-12 h-12 mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <p>Keranjang masih kosong</p>
                    </div>
                </div>

                <div class="p-5 bg-white border-t border-slate-100">

                    <div class="bg-gradient-to-r from-blue-50 to-slate-50 border border-blue-100 p-4 rounded-2xl flex justify-between items-center shadow-sm mb-5">
                        <div>
                            <span class="text-xs text-blue-500 font-extrabold uppercase tracking-widest">Total Bayar</span>
                        </div>
                        <div class="text-right">
                            <span class="text-2xl font-black text-brand-blue tracking-tight" id="cartTotal">Rp 0</span>
                        </div>
                    </div>

                    @if ($active_consoles->count() > 0)
                        <button type="submit"
                            class="w-full bg-brand-blue hover:bg-blue-800 text-white py-4 rounded-xl font-extrabold text-base shadow-lg shadow-blue-900/20 hover:shadow-xl transition-all transform hover:-translate-y-0.5 tracking-wide flex justify-center items-center gap-2">
                            PROSES PESANAN
                        </button>
                    @else
                        <button type="button" disabled
                            class="w-full bg-slate-200 text-slate-400 py-4 rounded-xl font-extrabold cursor-not-allowed border border-slate-300">
                            TIDAK ADA PLAYER AKTIF
                        </button>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <script>
    let cart = {};

    const formatRupiah = (number) => {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(number);
    }

    function togglePlayerDropdown() {
        const menu = document.getElementById('playerDropdownMenu');
        const icon = document.getElementById('playerDropdownIcon');

        if (menu.classList.contains('opacity-0')) {
            menu.classList.remove('opacity-0', 'invisible', 'scale-95');
            menu.classList.add('opacity-100', 'visible', 'scale-100');
            icon.classList.add('rotate-180');
        } else {
            closePlayerDropdown();
        }
    }

    function closePlayerDropdown() {
        const menu = document.getElementById('playerDropdownMenu');
        const icon = document.getElementById('playerDropdownIcon');

        menu.classList.add('opacity-0', 'invisible', 'scale-95');
        menu.classList.remove('opacity-100', 'visible', 'scale-100');
        icon.classList.remove('rotate-180');
    }

    function selectPlayer(id, text) {
        document.getElementById('selectedConsoleId').value = id;

        const btnText = document.getElementById('playerDropdownText');
        btnText.innerText = text;
        btnText.classList.remove('text-slate-400');
        btnText.classList.add('text-brand-blue');

        closePlayerDropdown();
    }

    document.addEventListener('click', function(event) {
        const wrapper = document.getElementById('playerDropdownWrapper');
        if (wrapper && !wrapper.contains(event.target)) {
            closePlayerDropdown();
        }
    });

    document.getElementById('orderForm').addEventListener('submit', function(e) {
        const selectedId = document.getElementById('selectedConsoleId').value;
        const btn = document.getElementById('playerDropdownBtn');

        if (!selectedId) {
            e.preventDefault();
            btn.classList.remove('border-slate-200');
            btn.classList.add('border-rose-500', 'ring-2', 'ring-rose-200');

            alert('Bro! Silakan pilih player dulu di bagian atas sebelum proses pesanan.');

            setTimeout(() => {
                btn.classList.remove('border-rose-500', 'ring-2', 'ring-rose-200');
                btn.classList.add('border-slate-200');
            }, 3000);
        }
    });

    function addToCart(id, name, price, stock) {
        id = String(id);
        price = parseInt(price);
        stock = parseInt(stock);

        if (cart[id] && cart[id].qty >= stock) {
            alert('Stok mentok bro! Cuma ada ' + stock);
            return;
        }

        if (cart[id]) {
            cart[id].qty++;
        } else {
            cart[id] = {
                id: id,
                name: name,
                price: price,
                qty: 1,
                stock: stock
            };
        }
        renderCart();
    }

    function changeQty(id, delta) {
        id = String(id);
        if (cart[id]) {
            let newQty = cart[id].qty + delta;

            if (delta > 0 && newQty > cart[id].stock) {
                alert('Stok habis bro!');
                return;
            }

            cart[id].qty = newQty;

            if (cart[id].qty <= 0) {
                delete cart[id];
            }
        }
        renderCart();
    }

    function renderCart() {
        const container = document.getElementById('cartContainer');
        const totalEl = document.getElementById('cartTotal');

        let grandTotal = 0;
        let itemCount = 0;
        let htmlContent = '';

        for (let key in cart) {
            let item = cart[key];
            let subtotal = item.price * item.qty;

            grandTotal += subtotal;
            itemCount++;

            htmlContent += `
                <div class="flex items-center justify-between bg-white p-4 rounded-xl border border-slate-100 shadow-sm mb-3 transition-all hover:border-blue-200 group">
                    <div class="flex-1 pr-2">
                        <h4 class="font-extrabold text-sm text-slate-800 tracking-tight leading-tight mb-1">${item.name}</h4>
                        <div class="flex items-center gap-3">
                            <p class="text-[11px] font-bold text-slate-400">@ ${formatRupiah(item.price)}</p>
                            <p class="text-xs font-black text-brand-blue">${formatRupiah(subtotal)}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-1 bg-slate-50 rounded-lg p-1 border border-slate-200">
                        <button type="button" onclick="changeQty('${item.id}', -1)" class="w-7 h-7 bg-white text-rose-500 rounded-md border border-slate-200 hover:bg-rose-50 hover:border-rose-200 font-black flex items-center justify-center shadow-sm transition-all">-</button>
                        <span class="font-extrabold text-sm w-8 text-center text-slate-700">${item.qty}</span>
                        <button type="button" onclick="changeQty('${item.id}', 1)" class="w-7 h-7 bg-white text-brand-blue rounded-md border border-slate-200 hover:bg-blue-50 hover:border-blue-200 font-black flex items-center justify-center shadow-sm transition-all">+</button>
                    </div>

                    <input type="hidden" name="qty[${item.id}]" value="${item.qty}">
                </div>
            `;
        }

        if (itemCount === 0) {
            htmlContent = `
                <div class="flex flex-col items-center justify-center h-full text-slate-400 text-sm italic font-semibold py-10 fade-in">
                    <svg class="w-12 h-12 mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    <p>Keranjang masih kosong</p>
                </div>
            `;
            grandTotal = 0;
        }

        container.innerHTML = htmlContent;
        totalEl.innerText = formatRupiah(grandTotal);
    }

    document.getElementById('searchMenu').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        let items = document.querySelectorAll('.menu-item-card');

        items.forEach(item => {
            let text = item.innerText.toLowerCase();
            if(text.includes(filter)) {
                item.style.display = '';
                item.parentElement.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    });
    </script>
@endsection
