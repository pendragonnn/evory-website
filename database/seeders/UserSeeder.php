<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin Evory',
            'email' => 'admin@evory.com',
            'phone' => '081234567890',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Customers (tanpa looping)
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'phone' => '081231111111',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        User::create([
            'name' => 'Siti Aminah',
            'email' => 'siti@example.com',
            'phone' => '081232222222',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        User::create([
            'name' => 'Agus Pratama',
            'email' => 'agus@example.com',
            'phone' => '081233333333',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        User::create([
            'name' => 'Dewi Lestari',
            'email' => 'dewi@example.com',
            'phone' => '081234444444',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        User::create([
            'name' => 'Rizky Kurniawan',
            'email' => 'rizky@example.com',
            'phone' => '081235555555',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        User::create([
            'name' => 'Putri Ayu',
            'email' => 'putri@example.com',
            'phone' => '081236666666',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        User::create([
            'name' => 'Ahmad Fauzan',
            'email' => 'fauzan@example.com',
            'phone' => '081237777777',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        User::create([
            'name' => 'Maya Sari',
            'email' => 'maya@example.com',
            'phone' => '081238888888',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        User::create([
            'name' => 'Fajar Hidayat',
            'email' => 'fajar@example.com',
            'phone' => '081239999999',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);
    }
}
