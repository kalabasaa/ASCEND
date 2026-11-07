<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // --- Admin user ---
        $admin = User::firstOrCreate(
            ['username' => 'admin.renier'],
            [
                'email' => 'admin.renier@gmail.com',
                'password' => Hash::make('Admin@12345'),
                'role' => 'admin',
            ]
        );

        // --- Staff user used on sales/payments ---
        $staff = User::firstOrCreate(
            ['username' => 'staff.jane'],
            [
                'email' => 'staff.jane@gmail.com',
                'password' => Hash::make('Staff@12345'),
                'role' => 'admin',
            ]
        );

        // --- 15 member-linked user accounts ---
        $memberUsers = collect(range(1, 15))->map(function ($i) {
            return User::firstOrCreate(
                ['username' => 'member' . $i],
                [
                    'email' => "member{$i}@example.com",
                    'password' => Hash::make('Member@12345'),
                    'role' => 'user',
                ]
            );
        });

        // --- Trainers ---
        $trainerNames = [
            ['Carlos', 'Reyes'], ['Mia', 'Santos'], ['Leo', 'Garcia'],
            ['Ava', 'Cruz'], ['Noah', 'Dizon'],
        ];
        $trainerIds = [];
        foreach ($trainerNames as [$fn, $ln]) {
            $trainerIds[] = DB::table('trainers')->insertGetId([
                'first_name' => $fn,
                'last_name' => $ln,
                'phone' => '09' . rand(100000000, 999999999),
                'email' => strtolower($fn) . '.' . strtolower($ln) . '@gym.com',
                'specialization' => collect(['Strength', 'Cardio', 'Yoga', 'CrossFit', 'Boxing'])->random(),
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // --- Membership plans ---
        $plans = [
            ['name' => 'Basic Monthly', 'days' => 30, 'price' => 500],
            ['name' => 'Premium Monthly', 'days' => 30, 'price' => 1200],
            ['name' => 'Quarterly Pro', 'days' => 90, 'price' => 3000],
            ['name' => 'Annual Elite', 'days' => 365, 'price' => 10000],
        ];
        $planIds = [];
        foreach ($plans as $plan) {
            $planIds[] = DB::table('membership_plans')->insertGetId([
                'trainer_id' => collect($trainerIds)->random(),
                'name' => $plan['name'],
                'description' => $plan['name'] . ' membership package',
                'duration_days' => $plan['days'],
                'price' => $plan['price'],
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // --- Members (some linked to users, some walk-in with no user_id) ---
        $firstNames = ['Juan', 'Maria', 'Jose', 'Ana', 'Pedro', 'Clara', 'Mark', 'Liza', 'Paolo', 'Nicole', 'Ramon', 'Grace', 'Ben', 'Joy', 'Rico'];
        $lastNames = ['Dela Cruz', 'Santos', 'Reyes', 'Garcia', 'Lopez', 'Torres', 'Flores', 'Ramos', 'Mendoza', 'Aquino', 'Castro', 'Rivera', 'Bautista', 'Gonzales', 'Villanueva'];

        $memberIds = [];
        foreach (range(0, 14) as $i) {
            $memberId = 'M' . str_pad($i + 1, 4, '0', STR_PAD_LEFT);
            $id = DB::table('members')->insertGetId([
                'member_id' => $memberId,
                'user_id' => $i < 10 ? $memberUsers[$i]->id : null, // first 10 linked, last 5 walk-in
                'first_name' => $firstNames[$i],
                'last_name' => $lastNames[$i],
                'phone' => '09' . rand(100000000, 999999999),
                'address' => rand(1, 999) . ' Sample St., Urdaneta City',
                'gender' => collect(['male', 'female'])->random(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $memberIds[] = $id;
        }

        // --- Subscriptions (most members get one active subscription) ---
        foreach ($memberIds as $i => $memberId) {
            if ($i % 4 === 3) continue; // leave a few members without subscriptions

            $planId = collect($planIds)->random();
            $start = now()->subDays(rand(0, 60));
            $end = (clone $start)->addDays(collect($plans)->firstWhere('name', DB::table('membership_plans')->find($planId)->name)['days'] ?? 30);

            DB::table('member_subscriptions')->insert([
                'member_id' => $memberId,
                'membership_plan_id' => $planId,
                'start_date' => $start->toDateString(),
                'end_date' => $end->toDateString(),
                'status' => $end->isPast() ? 'expired' : 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // --- Products ---
        $productList = [
            ['Whey Protein 1kg', 'Supplements', 1500, 20],
            ['Gym Gloves', 'Accessories', 300, 50],
            ['Shaker Bottle', 'Accessories', 150, 80],
            ['Pre-Workout 300g', 'Supplements', 900, 15],
            ['Resistance Bands Set', 'Equipment', 450, 30],
            ['Gym Towel', 'Accessories', 120, 100],
            ['Creatine 500g', 'Supplements', 700, 25],
            ['Lifting Belt', 'Equipment', 950, 10],
        ];
        $productIds = [];
        foreach ($productList as [$name, $cat, $price, $stock]) {
            $productIds[] = DB::table('products')->insertGetId([
                'name' => $name,
                'description' => $name . ' — gym store item',
                'category' => $cat,
                'price' => $price,
                'stock_quantity' => $stock,
                'low_stock_threshold' => 5,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // --- Sales + sold_products + payments ---
        foreach (range(1, 12) as $n) {
            $memberId = rand(0, 4) > 0 ? collect($memberIds)->random() : null; // some walk-in sales w/ no member
            $saleDate = now()->subDays(rand(0, 30));

            $items = collect($productIds)->random(rand(1, 3));
            $total = 0;
            $lineItems = [];

            foreach ($items as $productId) {
                $product = DB::table('products')->find($productId);
                $qty = rand(1, 3);
                $subtotal = $product->price * $qty;
                $total += $subtotal;
                $lineItems[] = [
                    'product_id' => $productId,
                    'quantity' => $qty,
                    'unit_price' => $product->price,
                    'subtotal' => $subtotal,
                ];
            }

            $saleId = DB::table('sales')->insertGetId([
                'member_id' => $memberId,
                'user_id' => $staff->id,
                'sale_date' => $saleDate,
                'total_amount' => $total,
                'status' => 'completed',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($lineItems as $item) {
                DB::table('sold_products')->insert(array_merge($item, [
                    'sale_id' => $saleId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]));
            }

            DB::table('payments')->insert([
                'payment_type' => 'product',
                'subscription_id' => null,
                'sale_id' => $saleId,
                'amount' => $total,
                'payment_method' => collect(['cash', 'gcash', 'card'])->random(),
                'payment_date' => $saleDate->toDateString(),
                'reference_number' => strtoupper(Str::random(8)),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // --- Payments for membership subscriptions ---
        $subs = DB::table('member_subscriptions')->get();
        foreach ($subs as $sub) {
            DB::table('payments')->insert([
                'payment_type' => 'membership',
                'subscription_id' => $sub->id,
                'sale_id' => null,
                'amount' => DB::table('membership_plans')->find($sub->membership_plan_id)->price,
                'payment_method' => collect(['cash', 'gcash', 'card'])->random(),
                'payment_date' => $sub->start_date,
                'reference_number' => strtoupper(Str::random(8)),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // --- Gym visits (last 10 days, random members) ---
        foreach (range(0, 9) as $daysAgo) {
            $visitDate = now()->subDays($daysAgo);
            $visitors = collect($memberIds)->random(rand(3, 8));
            foreach ($visitors as $memberId) {
                DB::table('gym_visits')->insert([
                    'member_id' => $memberId,
                    'check_in' => $visitDate->copy()->setTime(rand(6, 20), rand(0, 59)),
                ]);
            }
        }
    }
}