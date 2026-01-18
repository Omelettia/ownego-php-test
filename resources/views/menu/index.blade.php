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

            <div class="flex justify-between items-center mb-6">
                <button onclick="document.getElementById('filter-panel').classList.toggle('hidden')" 
                        class="bg-[#1e293b] text-white px-8 py-2 rounded shadow hover:bg-slate-800 transition flex items-center gap-3">
                    <span class="text-sm font-light">Filter</span>
                </button>

                <div class="flex items-center space-x-4">
                    <span class="text-slate-700 font-semibold text-sm">Sort By</span>
                    <form id="sortForm" action="{{ url()->current() }}" method="GET">
                        @foreach(request('topping', []) as $topping)
                            <input type="hidden" name="topping[]" value="{{ $topping }}">
                        @endforeach
                        
                        <select name="sort" onchange="this.form.submit()" 
                                class="border border-slate-400 rounded px-4 py-1.5 bg-[#f1f5f9] text-slate-700 focus:outline-none cursor-pointer text-sm min-w-[140px]">
                            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name</option>
                            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name (Desc)</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price (Low)</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price (High)</option>
                        </select>
                    </form>
                </div>
            </div>

            <div id="filter-panel" class="{{ request('topping') ? '' : 'hidden' }} bg-white p-8 rounded-sm shadow-sm border border-gray-100 mb-8">
                <form id="filterForm" action="{{ url()->current() }}" method="GET">
                    <input type="hidden" name="sort" value="{{ request('sort') }}">

                    <h3 class="font-bold text-[#1e293b] text-base mb-6">Toppings:</h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-y-6 gap-x-8">
                        @foreach($allToppings as $topping)
                            <label class="flex items-center space-x-4 cursor-pointer group">
                                <div class="relative flex items-center justify-center">
                                    <input type="checkbox" name="topping[]" value="{{ $topping }}"
                                        {{ in_array($topping, request('topping', [])) ? 'checked' : '' }}
                                        onchange="this.form.submit()"
                                        class="peer appearance-none w-6 h-6 border-2 border-slate-700 rounded-sm bg-white checked:bg-white transition-all cursor-pointer">
                                    <div class="absolute w-3.5 h-3.5 bg-[#1e293b] opacity-0 peer-checked:opacity-100 pointer-events-none transition-opacity"></div>
                                </div>
                                <span class="text-slate-700 group-hover:text-[#1e293b] font-medium transition text-lg">{{ $topping }}</span>
                            </label>
                        @endforeach
                    </div>
                </form>
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