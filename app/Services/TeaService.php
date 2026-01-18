<?php

namespace App\Services;

class TeaService
{
    public function getMenuData(array $filters = [])
    {
        $loadJson = function ($filename) {
            $path = storage_path('app/json/' . $filename);

            if (!file_exists($path)) {
                return [];
            }

            $content = file_get_contents($path);

            // Remove invisible "BOM" characters (common in Windows files)
            // preventing json_decode errors.
            if (strpos($content, "\xEF\xBB\xBF") === 0) {
                $content = substr($content, 3);
            }

            return json_decode($content, true) ?? [];
        };

        $productsRaw = $loadJson('products.json');
        $storesRaw = $loadJson('stores.json');
        $storeProductsRaw = $loadJson('storeProducts.json');

        $products = $productsRaw['products'] ?? $productsRaw ?? [];
        $stores = $storesRaw['stores'] ?? $storesRaw ?? [];
        $shopProducts = $storeProductsRaw['shopProducts'] ?? $storeProductsRaw ?? [];

        $products = collect($products)->map(function ($item) {
            if (isset($item['toppings']) && is_string($item['toppings'])) {
                $item['toppings'] = array_map('trim', explode(',', $item['toppings']));
            }
            return $item;
        });

        // Get Toppings List (Standardized)
        $allToppings = $products->pluck('toppings')
            ->flatten()
            ->map(function ($item) {
                return ucfirst(strtolower($item));
            })
            ->unique()
            ->values();

        //Filter by topping
        if (!empty($filters['toppings'])) {
            $products = $products->filter(function ($product) use ($filters) {
                $productToppings = array_map('strtolower', $product['toppings']);
                
                $selectedToppings = array_map('strtolower', $filters['toppings']);

                return count(array_intersect($productToppings, $selectedToppings)) === count($selectedToppings);
            });
        }

        $sort = $filters['sort'] ?? 'name_asc';
        //Sorting
        switch ($sort) {
            case 'price_asc':
                $products = $products->sortBy('price');
                break;
            case 'price_desc':
                $products = $products->sortByDesc('price');
                break;
            case 'name_desc':
                $products = $products->sortByDesc('name');
                break;
            default: 
                $products = $products->sortBy('name');
                break;
        }

        return [
            'products' => $products,
            'stores' => collect($stores),
            'storeProducts' => collect($shopProducts),
            'allToppings' => $allToppings
        ];
    }
}