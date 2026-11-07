<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    private const METHODS = ['cash', 'card', 'gcash', 'bank transfer'];

    public function run(): void
    {
        // Membership payments for any subscription that has none yet
        $subscriptions = DB::table('member_subscriptions')
            ->whereNotIn('id', DB::table('payments')->whereNotNull('subscription_id')->select('subscription_id'))
            ->get();

        foreach ($subscriptions as $subscription) {
            $this->pay('subscription', $subscription->id, null, $subscription->amount, $subscription->start_date);
        }

        // Product payments for any sale that has none yet
        $sales = DB::table('sales')
            ->whereNotIn('id', DB::table('payments')->whereNotNull('sale_id')->select('sale_id'))
            ->get();

        foreach ($sales as $sale) {
            $this->pay('sale', null, $sale->id, $sale->total_amount, $sale->sale_date);
        }
    }

    private function pay(string $type, ?int $subscriptionId, ?int $saleId, $amount, $date): void
    {
        $when = now()->parse($date);
        $method = self::METHODS[array_rand(self::METHODS)];

        DB::table('payments')->insert([
            'payment_type' => $type,
            'subscription_id' => $subscriptionId,
            'sale_id' => $saleId,
            'amount' => $amount,
            'payment_method' => $method,
            'payment_date' => $when->toDateString(),
            'reference_number' => $method === 'cash'
                ? null
                : strtoupper(substr(md5(uniqid((string) ($subscriptionId ?? $saleId), true)), 0, 10)),
            'created_at' => $when,
            'updated_at' => $when,
        ]);
    }
}