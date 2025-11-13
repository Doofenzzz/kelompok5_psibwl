<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Nasabah;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin BPR',
            'email' => 'admin@bpr.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
    }
}