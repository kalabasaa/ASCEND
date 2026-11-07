<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $password = Hash::make('password');
        $streets = ['Rizal St.', 'Mabini St.', 'Bonifacio Ave.', 'Del Pilar St.', 'Quezon Blvd.'];

        $people = [
            ['Juan', 'Dela Cruz', 'male'],
            ['Maria', 'Garcia', 'female'],
            ['Miguel', 'Ramos', 'male'],
            ['Angela', 'Bautista', 'female'],
            ['Carlo', 'Aquino', 'male'],
            ['Bea', 'Castillo', 'female'],
            ['Paolo', 'Navarro', 'male'],
            ['Camille', 'Tolentino', 'female'],
            ['Gabriel', 'Pascual', 'male'],
            ['Denise', 'Soriano', 'female'],
            ['Jose', 'Mendoza', 'male'],
            ['Elena', 'Flores', 'female'],
            ['Andres', 'Lim', 'male'],
            ['Francesca', 'Tan', 'female'],
            ['Luis', 'Cruz', 'male'],
            ['Grace', 'Torres', 'female'],
            ['Dominic', 'Salazar', 'male'],
            ['Hannah', 'Valdez', 'female'],
            ['Enzo', 'Ortega', 'male'],
            ['Jasmine', 'Fernandez', 'female'],
        ];

        foreach ($people as $index => [$first, $last, $gender]) {
            $number = $index + 1;
            $joined = now()->subDays(random_int(40, 200));
            $username = strtolower(str_replace(' ', '', $first.$last));
            $email = $username.'@example.com';

            DB::table('users')->updateOrInsert(
                ['email' => $email],
                [
                    'username' => $username,
                    'email_verified_at' => now(),
                    'password' => $password,
                    'role' => 'user',
                    'created_at' => $joined,
                    'updated_at' => $joined,
                ]
            );

            $userId = DB::table('users')->where('email', $email)->value('id');

            DB::table('members')->updateOrInsert(
                ['member_id' => 'MBR-'.str_pad((string) $number, 4, '0', STR_PAD_LEFT)],
                [
                    'user_id' => $userId,
                    'first_name' => $first,
                    'last_name' => $last,
                    'phone' => '09'.random_int(100000000, 999999999),
                    'address' => random_int(1, 300).' '.$streets[array_rand($streets)].', Urdaneta, Pangasinan',
                    'gender' => $gender,
                    'created_at' => $joined,
                    'updated_at' => $joined,
                ]
            );
        }
    }
}
