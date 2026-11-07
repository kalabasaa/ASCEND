<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SaleSeeder extends Seeder
{
    public function run(): void
    {
        $adminId = DB::table('users')->where('role', 'admin')->value('id');
        $memberIds = DB::table('members')->pluck('id')->all();
        $products = DB::table('products')->where('status', 'active')->get();

        if (! $adminId || ! $memberIds || $products->isEmpty()) {
            $this->command?->warn('SaleSeeder skipped: admin, members or products are missing.');

            return;
        }

        for ($i = 0; $i < 50; $i++) {
            // The first 5 sales are from today so the dashboard has fresh data
            $daysAgo = $i < 5 ? 0 : random_int(1, 60);
            $saleDate = now()->subDays($daysAgo)->setTime(random_int(7, 20), random_int(0, 59), 0);

            // About 25% are walk-in sales with no member
            $memberId = random_int(1, 4) === 1 ? null : $memberIds[array_rand($memberIds)];

            $lines = [];
            $total = 0;

            foreach ($products->random(min(random_int(1, 3), $products->count())) as $product) {
                $qty = random_int(1, 3);
                $subtotal = $qty * $product->price;
                $total += $subtotal;

                $lines[] = [
                    'product_id' => $product->id,
                    'quantity' => $qty,
                    'unit_price' => $product->price,
                    'subtotal' => $subtotal,
                    'created_at' => $saleDate,
                    'updated_at' => $saleDate,
                ];
            }

            $saleId = DB::table('sales')->insertGetId([
                'member_id' => $memberId,
                'user_id' => $adminId,
                'sale_date' => $saleDate,
                'total_amount' => $total,
                'status' => 'completed',
                'created_at' => $saleDate,
                'updated_at' => $saleDate,
            ]);

            foreach ($lines as &$line) {
                $line['sale_id'] = $saleId;
            }
            unset($line);

            DB::table('sold_products')->insert($lines);
        }
    }
}