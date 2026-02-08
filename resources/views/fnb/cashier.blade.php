@extends('layouts.main')

@section('judul_halaman', 'Order Makanan & Minuman')

@section('konten')
    <div class="flex gap-6 h-[calc(100vh-140px)]">

        <div class="flex-1 bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden flex flex-col">
            <div class="p-4 border-b border-gray-100 bg-gray-50 z-10 sticky top-0">
                <input type="text" id="searchMenu" placeholder="Cari menu..."
                    class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div class="flex-1 overflow-y-auto p-4 bg-gray-50 space-y-8">

                <div>
                    <h3 class="text-lg font-black text-gray-800 mb-3 flex items-center gap-2 border-b border-gray-200 pb-2">
                        <span>🍜</span> Makanan
                    </h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @forelse($products->where('category', 'makanan') as $item)
                            @include('fnb.partials.menu-card', ['item' => $item])
                        @empty
                            <p class="text-gray-400 text-sm italic">Tidak ada makanan.</p>
                        @endforelse
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-black text-gray-800 mb-3 flex items-center gap-2 border-b border-gray-200 pb-2">
                        <span>🥤</span> Minuman
                    </h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @forelse($products->where('category', 'minuman') as $item)
                            @include('fnb.partials.menu-card', ['item' => $item])
                        @empty
                            <p class="text-gray-400 text-sm italic">Tidak ada minuman.</p>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>

        <div class="w-96 bg-white rounded-2xl shadow-lg border border-gray-200 flex flex-col h-full">

            <div class="p-4 bg-[#2251a5] text-white rounded-t-xl">
                <h3 class="font-bold text-lg flex items-center gap-2">
                    Pesanan Baru
                </h3>
            </div>

            <form action="{{ route('booking.addOrder') }}" method="POST" class="flex-1 flex flex-col overflow-hidden">
                @csrf

                <div class="p-4 border-b border-gray-100 bg-blue-50">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Kirim ke:</label>
                    <select name="console_id"
                        class="w-full bg-white border border-gray-300 rounded-lg p-2.5 font-bold text-gray-800 focus:ring-2 focus:ring-blue-500"
                        required>
                        <option value="" disabled selected>Pilih Player Aktif</option>
                        @forelse($active_consoles as $console)
                            <option value="{{ $console->id }}">
                                {{ $console->name }}
                                ({{ $console->activeTransaction ? Str::limit($console->activeTransaction->customer_name, 10) : 'Unknown' }})
                            </option>
                        @empty
                            <option value="" disabled>Kosong</option>
                        @endforelse
                    </select>
                </div>

                <div class="flex-1 overflow-y-auto p-4 space-y-3" id="cartContainer">
                    <div class="flex flex-col items-center justify-center h-full text-gray-400 text-sm italic"
                        id="emptyCartText">
                        <svg class="w-10 h-10 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                        <p>Keranjang kosong</p>
                    </div>
                </div>

                <div class="p-4 bg-gray-50 border-t border-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-gray-500 font-bold">Total Bayar</span>
                        <span class="text-2xl font-black text-blue-600" id="cartTotal">Rp 0</span>
                    </div>

                    @if ($active_consoles->count() > 0)
                        <button type="submit"
                            class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl font-bold text-lg shadow-lg transition transform active:scale-95">
                            PROSES PESANAN
                        </button>
                    @else
                        <button type="button" disabled
                            class="w-full bg-gray-300 text-gray-500 py-3 rounded-xl font-bold cursor-not-allowed">
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

    // 1. FUNGSI ADD DARI MENU
    function addToCart(id, name, price, stock) {
        id = String(id);
        price = parseInt(price);
        stock = parseInt(stock);

        // Cek stok
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
                alert('Stok habis!');
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
                <div class="flex items-center justify-between bg-white p-3 rounded-lg border border-gray-100 shadow-sm mb-2">
                    <div class="flex-1">
                        <h4 class="font-bold text-sm text-gray-800">${item.name}</h4>
                        <div class="flex justify-between w-full pr-4">
                            <p class="text-xs text-gray-500">@ ${formatRupiah(item.price)}</p>
                            <p class="text-xs font-bold text-blue-600">${formatRupiah(subtotal)}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 bg-gray-50 rounded p-1">
                        <button type="button" onclick="changeQty('${item.id}', -1)" class="w-7 h-7 bg-white text-red-500 rounded border border-gray-200 hover:bg-red-50 font-black flex items-center justify-center">-</button>
                        <span class="font-bold text-sm w-6 text-center">${item.qty}</span>
                        <button type="button" onclick="changeQty('${item.id}', 1)" class="w-7 h-7 bg-white text-blue-600 rounded border border-gray-200 hover:bg-blue-50 font-black flex items-center justify-center">+</button>
                    </div>

                    <input type="hidden" name="qty[${item.id}]" value="${item.qty}">
                </div>
            `;
        }

        if (itemCount === 0) {
            htmlContent = `
                <div class="flex flex-col items-center justify-center h-full text-gray-400 text-sm italic py-10 fade-in">
                    <svg class="w-10 h-10 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    <p>Keranjang kosong</p>
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
