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
            'name' => 'Adrian Ferdinand',
            'email' => 'adrianferdinand@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('admin12345'),
        ]);

        // User biasa
        User::create([
            'name' => 'Dimas Meisandi',
            'email' => 'dimasmeisandi@gmail.com',
            'role' => 'cashier',
            'password' => Hash::make('cashier12345'),
        ]);
    }
}