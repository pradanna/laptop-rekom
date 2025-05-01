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
    }
}
