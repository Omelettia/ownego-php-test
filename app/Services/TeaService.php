<?php

namespace App\Services;

class TeaService
{
    public function getMenuData()
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

        return [
            'products' => $products,
            'stores' => collect($stores),
            'storeProducts' => collect($shopProducts),
        ];
    }
}