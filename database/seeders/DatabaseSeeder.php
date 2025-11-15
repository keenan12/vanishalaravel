<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ===== CREATE USERS =====
        User::create([
            'name' => 'Admin Vanisha',
            'email' => 'admin@vanisha.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'avatar' => null,
            'theme' => 'light',
            'remember_token' => null,
        ]);

        User::create([
            'name' => 'Customer Test',
            'email' => 'customer@vanisha.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'role' => 'customer',
            'avatar' => null,
            'theme' => 'light',
            'remember_token' => null,
        ]);

        // ===== CREATE CATEGORIES =====
        $categories = [
            ['name' => 'Roti', 'slug' => 'roti'],
            ['name' => 'Kue', 'slug' => 'kue'],
            ['name' => 'Pastry', 'slug' => 'pastry'],
            ['name' => 'Donat', 'slug' => 'donat'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // ===== CREATE PRODUCTS =====
        $products = [
            [
                'name' => 'Roti Tawar',
                'description' => 'Roti tawar lembut dan segar',
                'category_id' => 1,
                'price' => 15000,
                'stock' => 50,
                'sku' => 'SKU-ROTI-TAWAR-001',
                'image' => null,
                'status' => 'active',
            ],
            [
                'name' => 'Roti Gandum',
                'description' => 'Roti gandum 100% murni',
                'category_id' => 1,
                'price' => 20000,
                'stock' => 30,
                'sku' => 'SKU-ROTI-GANDUM-001',
                'image' => null,
                'status' => 'active',
            ],
            [
                'name' => 'Kue Coklat',
                'description' => 'Kue coklat manis dan lezat',
                'category_id' => 2,
                'price' => 25000,
                'stock' => 20,
                'sku' => 'SKU-KUE-COKLAT-001',
                'image' => null,
                'status' => 'active',
            ],
            [
                'name' => 'Croissant',
                'description' => 'Croissant butter premium',
                'category_id' => 3,
                'price' => 15000,
                'stock' => 40,
                'sku' => 'SKU-CROISSANT-001',
                'image' => null,
                'status' => 'active',
            ],
            [
                'name' => 'Donat Vanila',
                'description' => 'Donat dengan rasa vanila asli',
                'category_id' => 4,
                'price' => 8000,
                'stock' => 100,
                'sku' => 'SKU-DONAT-VANILA-001',
                'image' => null,
                'status' => 'active',
            ],
            [
                'name' => 'Donat Coklat',
                'description' => 'Donat dengan topping coklat',
                'category_id' => 4,
                'price' => 8000,
                'stock' => 80,
                'sku' => 'SKU-DONAT-COKLAT-001',
                'image' => null,
                'status' => 'active',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
