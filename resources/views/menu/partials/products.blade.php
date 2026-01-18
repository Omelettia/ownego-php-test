@foreach($products as $product)
    <div class="bg-white rounded-lg p-6 shadow-sm hover:shadow-md transition border border-gray-100 flex flex-col justify-between h-full">
        <div>
            <div class="text-gray-500 text-sm mb-1 font-medium">MT-{{ str_pad($product['id'], 2, '0', STR_PAD_LEFT) }}</div>
            <h3 class="text-xl font-bold text-[#1e293b] mb-3">{{ $product['name'] }}</h3>
            <hr class="border-gray-200 mb-3">
            <div class="mb-6">
                <span class="text-sm font-bold text-[#1e293b]">Toppings:</span>
                <p class="text-sm text-gray-600 mt-1 leading-relaxed">{{ implode(', ', $product['toppings']) }}</p>
            </div>
        </div>
        <div class="flex justify-between items-center mt-auto">
            <span class="bg-[#1e293b] text-white text-xs px-3 py-1 rounded">Trending</span>
            <span class="text-xl font-bold text-[#1e293b]">${{ number_format($product['price'], 1) }}</span>
        </div>
    </div>
@endforeach