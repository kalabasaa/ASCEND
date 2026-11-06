<?php

namespace Database\Seeders;

use App\Models\MembershipPlan;
use App\Models\Trainer;
use Illuminate\Database\Seeder;

class MembershipPlanSeeder extends Seeder
{
    public function run(): void
    {
        $trainer = Trainer::first();

        $plans = [
            ['name' => 'Basic Monthly', 'duration_days' => 30, 'price' => 999.00],
            ['name' => 'Premium Monthly', 'duration_days' => 30, 'price' => 1999.00],
            ['name' => 'Annual', 'duration_days' => 365, 'price' => 14999.00],
        ];

        foreach ($plans as $plan) {
            MembershipPlan::firstOrCreate(
                ['name' => $plan['name']],
                $plan + ['trainer_id' => $trainer?->id, 'status' => 'active']
            );
        }
    }
}