<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin Master',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Pembeli 1
        User::create([
            'name' => 'Pembeli Satu',
            'email' => 'pembeli1@example.com',
            'password' => Hash::make('password'),
            'role' => 'pembeli',
        ]);

        // Pembeli 2
        User::create([
            'name' => 'Pembeli Dua',
            'email' => 'pembeli2@example.com',
            'password' => Hash::make('password'),
            'role' => 'pembeli',
        ]);

        Member::create([
            'user_id' => 2, // ID Pembeli Satu
            'name' => 'Pembeli Satu',
            'phone' => '081234567890',
            'address' => 'Jl. Mawar No.1, Sukoharjo',
        ]);

        Member::create([
            'user_id' => 3, // ID Pembeli Dua
            'name' => 'Pembeli Dua',
            'phone' => '082345678901',
            'address' => 'Jl. Melati No.2, Sukoharjo',
        ]);
    }
}
