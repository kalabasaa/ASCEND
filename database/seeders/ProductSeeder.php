<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name' => 'Whey Protein 1kg', 'category' => 'Supplements', 'price' => 1299.00, 'stock_quantity' => 20],
            ['name' => 'Shaker Bottle', 'category' => 'Accessories', 'price' => 199.00, 'stock_quantity' => 50],
            ['name' => 'Gym Towel', 'category' => 'Accessories', 'price' => 149.00, 'stock_quantity' => 40],
            ['name' => 'Energy Drink', 'category' => 'Beverages', 'price' => 65.00, 'stock_quantity' => 100],
        ];

        foreach ($products as $product) {
            Product::firstOrCreate(
                ['name' => $product['name']],
                $product + ['low_stock_threshold' => 5, 'status' => 'active']
            );
        }
    }
}