<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\MembershipPlan;
use App\Models\MemberSubscription;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoMemberSeeder extends Seeder
{
    public function run(): void
    {
        $plan = MembershipPlan::first();

        $demoMembers = [
            ['username' => 'juan_dc', 'first_name' => 'Juan', 'last_name' => 'Dela Cruz'],
            ['username' => 'anna_m', 'first_name' => 'Anna', 'last_name' => 'Mendoza'],
        ];

        foreach ($demoMembers as $demo) {
            $user = User::firstOrCreate(
                ['username' => $demo['username']],
                [
                    'email' => $demo['username'] . '@ascend.test',
                    'password' => Hash::make('password'),
                    'role' => 'user',
                ]
            );

            $member = $user->member()->firstOrCreate([], [
                'first_name' => $demo['first_name'],
                'last_name' => $demo['last_name'],
                'gender' => 'unspecified',
            ]);

            if ($plan) {
                MemberSubscription::firstOrCreate(
                    ['member_id' => $member->id, 'membership_plan_id' => $plan->id],
                    [
                        'start_date' => now(),
                        'end_date' => now()->addDays($plan->duration_days),
                        'amount' => $plan->price,
                        'status' => 'active',
                    ]
                );
            }
        }
    }
}