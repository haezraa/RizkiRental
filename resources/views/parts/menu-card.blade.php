<div class="menu-item-card bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition cursor-pointer group flex flex-col h-full"
    onclick="addToCart('{{ $item->id }}', '{{ $item->name }}', '{{ $item->price }}', '{{ $item->stock }}')">

    <div class="h-32 bg-gray-100 relative overflow-hidden flex items-center justify-center">
        @if($item->image)
            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
        @else
            <span class="text-4xl opacity-30">{{ $item->category == 'makanan' ? '🍜' : '🥤' }}</span>
        @endif

        <div class="absolute top-2 left-2 bg-white/90 px-2 py-0.5 rounded text-[10px] font-bold text-gray-600 shadow-sm">
            Stok: {{ $item->stock }}
        </div>
    </div>

    <div class="p-3 flex flex-col flex-1">
        <h4 class="font-bold text-gray-800 text-sm leading-tight mb-1 line-clamp-2">{{ $item->name }}</h4>
        <div class="mt-auto flex justify-between items-end">
            <span class="text-blue-600 font-black text-sm">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
            <button class="w-6 h-6 rounded bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-lg hover:bg-blue-600 hover:text-white transition">+</button>
        </div>
    </div>
</div>
