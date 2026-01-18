<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Milk Tea Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#F3F4F6]">

    <div class="flex min-h-screen">
        <aside class="w-64 bg-[#1e293b] text-white flex-shrink-0">
            <div class="p-6">
                <h1 class="text-xl font-bold tracking-wide">Milk Tea Store</h1>
            </div>
            <nav class="mt-4">
                @foreach($stores as $store)
                    <a href="#" class="block px-6 py-4 text-gray-300 hover:bg-[#334155] hover:text-white transition-colors {{ $loop->first ? 'bg-[#334155] text-white border-l-4 border-blue-400' : '' }}">
                        {{ $store['name'] }}
                    </a>
                @endforeach
            </nav>
        </aside>

        <main class="flex-1 p-8 md:p-12">
            
            <div class="text-center mb-10">
                <h2 class="text-4xl font-bold text-[#1e293b]">Store 1  Menu</h2>
            </div>

            <div class="flex justify-between items-center mb-8">
                <button class="bg-[#1e293b] text-white px-6 py-2 rounded shadow hover:bg-slate-700 transition">
                    Filter
                </button>

                <div class="flex items-center space-x-2">
                    <span class="text-gray-600 font-medium">Sort By</span>
                    <select class="border-2 border-gray-300 rounded px-3 py-2 bg-transparent text-gray-700 focus:outline-none focus:border-blue-500">
                        <option>Name (Asc)</option>
                        <option>Name (Desc)</option>
                        <option>Price (Asc)</option>
                        <option>Price (Desc)</option>
                    </select>
                </div>
            </div>

            {{-- <div class="bg-white p-6 rounded-lg shadow-sm mb-8">...Checkboxes...</div> --}}

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($products as $product)
                    <div class="bg-white rounded-lg p-6 shadow-sm hover:shadow-md transition duration-300 border border-gray-100 flex flex-col justify-between h-full">
                        
                        <div>
                            <div class="text-gray-500 text-sm mb-1 font-medium">MT-{{ str_pad($product['id'], 2, '0', STR_PAD_LEFT) }}</div>
                            <h3 class="text-xl font-bold text-[#1e293b] mb-3">{{ $product['name'] }}</h3>
                            
                            <hr class="border-gray-200 mb-3">

                            <div class="mb-6">
                                <span class="text-sm font-bold text-[#1e293b]">Toppings:</span>
                                <p class="text-sm text-gray-600 mt-1 leading-relaxed">
                                    {{ implode(', ', $product['toppings']) }}
                                </p>
                            </div>
                        </div>

                        <div class="flex justify-between items-center mt-auto">
                            <span class="bg-[#1e293b] text-white text-xs px-3 py-1 rounded">Trending</span>
                            
                            <span class="text-xl font-bold text-[#1e293b]">${{ number_format($product['price'], 1) }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </main>
    </div>

</body>
</html>