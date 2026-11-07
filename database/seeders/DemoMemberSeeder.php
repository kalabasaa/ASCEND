<?php

namespace Database\Seeders;

use App\Models\MembershipPlan;
use App\Models\Trainer;
use Illuminate\Database\Seeder;

class MembershipPlanSeeder extends Seeder
{
    public function run(): void
    {
        $trainers = Trainer::pluck('id');
        $first = $trainers->get(0);

        $plans = [
            // Your original plans
            ['name' => 'Basic Monthly', 'duration_days' => 30, 'price' => 999.00],
            ['name' => 'Premium Monthly', 'duration_days' => 30, 'price' => 1999.00],
            ['name' => 'Annual', 'duration_days' => 365, 'price' => 14999.00],

            // Extra plans
            ['name' => 'Day Pass', 'duration_days' => 1, 'price' => 150.00, 'trainer_id' => null],
            ['name' => 'Weekly Pass', 'duration_days' => 7, 'price' => 700.00, 'trainer_id' => null],
            ['name' => 'Quarterly Strength', 'duration_days' => 90, 'price' => 5500.00, 'trainer_id' => $trainers->get(1)],
            ['name' => 'Yoga & Mobility Monthly', 'duration_days' => 30, 'price' => 2200.00, 'trainer_id' => $trainers->get(2)],
            ['name' => 'Legacy Student', 'duration_days' => 30, 'price' => 1000.00, 'trainer_id' => null, 'status' => 'inactive'],
        ];

        foreach ($plans as $plan) {
            MembershipPlan::firstOrCreate(
                ['name' => $plan['name']],
                $plan + ['trainer_id' => $first, 'status' => 'active']
            );
        }
    }
}
