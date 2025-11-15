<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Vanisha',
            'email' => 'admin@vanisha.com',
            'password' => Hash::make('password123'),
        ]);
    }
}
