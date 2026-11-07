<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['username' => 'admin.renier'],
            [
                'email' => 'admin.renier@gmail.com',
                'password' => Hash::make('Admin@12345'),
                'role' => 'admin',
            ]
        );

        // Your admin routes use the `verified` middleware, so mark the account as verified.
        // forceFill avoids a mass-assignment error if the column isn't in $fillable.
        if (Schema::hasColumn('users', 'email_verified_at')) {
            $admin->forceFill(['email_verified_at' => now()])->save();
        }
    }
}
