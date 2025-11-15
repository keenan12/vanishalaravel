<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Roti Tawar',
                'description' => 'Roti tawar putih dan gandum, cocok untuk sarapan keluarga'
            ],
            [
                'name' => 'Roti Isi',
                'description' => 'Roti dengan berbagai isian: coklat, keju, daging, dan lainnya'
            ],
            [
                'name' => 'Pastry',
                'description' => 'Pastry dan cake premium dengan resep special'
            ],
            [
                'name' => 'Croissant',
                'description' => 'Croissant butter premium, layer renyah sempurna'
            ],
            [
                'name' => 'Donut',
                'description' => 'Donut dengan berbagai topping dan rasa favorit'
            ],
            [
                'name' => 'Roti Spesial',
                'description' => 'Roti-roti spesial dan edisi terbatas'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
