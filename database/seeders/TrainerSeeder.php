<?php

namespace Database\Seeders;

use App\Models\Trainer;
use Illuminate\Database\Seeder;

class TrainerSeeder extends Seeder
{
    public function run(): void
    {
        $trainers = [
            ['first_name' => 'Carlos', 'last_name' => 'Reyes', 'specialization' => 'Strength Training'],
            ['first_name' => 'Maria', 'last_name' => 'Santos', 'specialization' => 'Cardio & Conditioning'],
            ['first_name' => 'Jake', 'last_name' => 'Dela Cruz', 'specialization' => 'CrossFit'],
        ];

        foreach ($trainers as $trainer) {
            Trainer::firstOrCreate(
                ['first_name' => $trainer['first_name'], 'last_name' => $trainer['last_name']],
                $trainer + ['status' => 'active']
            );
        }
    }
}
