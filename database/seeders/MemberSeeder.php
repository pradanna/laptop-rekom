<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        Member::create([
            'user_id' => 2, // ID Pembeli Satu
            'phone' => '081234567890',
            'address' => 'Jl. Mawar No.1, Sukoharjo',
        ]);

        Member::create([
            'user_id' => 3, // ID Pembeli Dua
            'phone' => '082345678901',
            'address' => 'Jl. Melati No.2, Sukoharjo',
        ]);
    }
}
