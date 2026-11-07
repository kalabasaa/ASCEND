<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Your original products
            ['name' => 'Whey Protein 1kg', 'category' => 'Supplements', 'price' => 1299.00, 'stock_quantity' => 20],
            ['name' => 'Shaker Bottle', 'category' => 'Accessories', 'price' => 199.00, 'stock_quantity' => 50],
            ['name' => 'Gym Towel', 'category' => 'Accessories', 'price' => 149.00, 'stock_quantity' => 40],
            ['name' => 'Energy Drink', 'category' => 'Beverages', 'price' => 65.00, 'stock_quantity' => 100],

            // Supplements
            ['name' => 'Whey Protein 2.3kg', 'category' => 'Supplements', 'price' => 2899.00, 'stock_quantity' => 12],
            ['name' => 'Creatine Monohydrate 300g', 'category' => 'Supplements', 'price' => 950.00, 'stock_quantity' => 18],
            ['name' => 'BCAA Powder', 'category' => 'Supplements', 'price' => 1100.00, 'stock_quantity' => 4],   // low stock
            ['name' => 'Pre-Workout Mix', 'category' => 'Supplements', 'price' => 1250.00, 'stock_quantity' => 0], // out of stock
            ['name' => 'Multivitamins 60s', 'category' => 'Supplements', 'price' => 580.00, 'stock_quantity' => 25],

            // Snacks
            ['name' => 'Protein Bar', 'category' => 'Snacks', 'price' => 85.00, 'stock_quantity' => 120, 'low_stock_threshold' => 20],
            ['name' => 'Energy Gel', 'category' => 'Snacks', 'price' => 60.00, 'stock_quantity' => 60, 'low_stock_threshold' => 15],
            ['name' => 'Peanut Butter Pack', 'category' => 'Snacks', 'price' => 120.00, 'stock_quantity' => 8],

            // Beverages
            ['name' => 'Bottled Water 500ml', 'category' => 'Beverages', 'price' => 25.00, 'stock_quantity' => 200, 'low_stock_threshold' => 30],
            ['name' => 'Sports Drink 500ml', 'category' => 'Beverages', 'price' => 45.00, 'stock_quantity' => 90, 'low_stock_threshold' => 20],
            ['name' => 'Iced Coffee Can', 'category' => 'Beverages', 'price' => 70.00, 'stock_quantity' => 3],   // low stock

            // Accessories
            ['name' => 'Lifting Straps', 'category' => 'Accessories', 'price' => 350.00, 'stock_quantity' => 15],
            ['name' => 'Resistance Band Set', 'category' => 'Accessories', 'price' => 650.00, 'stock_quantity' => 3], // low stock
            ['name' => 'Jump Rope', 'category' => 'Accessories', 'price' => 300.00, 'stock_quantity' => 22],
            ['name' => 'Lifting Gloves', 'category' => 'Accessories', 'price' => 420.00, 'stock_quantity' => 14],

            // Apparel
            ['name' => 'Ascend Tank Top', 'category' => 'Apparel', 'price' => 450.00, 'stock_quantity' => 35, 'low_stock_threshold' => 8],
            ['name' => 'Ascend Gym Shorts', 'category' => 'Apparel', 'price' => 550.00, 'stock_quantity' => 28, 'low_stock_threshold' => 8],
            ['name' => 'Ascend Hoodie', 'category' => 'Apparel', 'price' => 1200.00, 'stock_quantity' => 10, 'low_stock_threshold' => 4],
            ['name' => 'Old Logo Cap', 'category' => 'Apparel', 'price' => 300.00, 'stock_quantity' => 6, 'status' => 'inactive'],
        ];

        foreach ($products as $product) {
            Product::firstOrCreate(
                ['name' => $product['name']],
                $product + [
                    'description' => $product['name'].' available at the Ascend shop.',
                    'low_stock_threshold' => 5,
                    'status' => 'active',
                ]
            );
        }
    }
}
