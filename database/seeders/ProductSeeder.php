<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Roti Tawar Putih 1 Loaf',
                'sku' => 'RTW-001',
                'price' => 25000,
                'stock' => 50,
                'description' => 'Roti tawar putih premium, empuk dan lezat, cocok untuk sarapan keluarga',
                'status' => 'active'
            ],
            [
                'name' => 'Roti Tawar Gandum 1 Loaf',
                'sku' => 'RTW-002',
                'price' => 30000,
                'stock' => 35,
                'description' => 'Roti tawar gandum utuh, kaya serat dan bergizi, pilihan sehat',
                'status' => 'active'
            ],
            [
                'name' => 'Roti Isi Coklat',
                'sku' => 'RIS-001',
                'price' => 15000,
                'stock' => 60,
                'description' => 'Roti isi coklat lembut, aroma coklat yang harum, favorit anak-anak',
                'status' => 'active'
            ],
            [
                'name' => 'Roti Isi Keju Mozzarella',
                'sku' => 'RIS-002',
                'price' => 18000,
                'stock' => 45,
                'description' => 'Roti isi keju mozzarella premium, gurih dan berkeju',
                'status' => 'active'
            ],
            [
                'name' => 'Roti Isi Daging Cincang',
                'sku' => 'RIS-003',
                'price' => 20000,
                'stock' => 30,
                'description' => 'Roti isi daging cincang pilihan, rasa gurih dan nikmat',
                'status' => 'active'
            ],
            [
                'name' => 'Croissant Butter Layer',
                'sku' => 'CRS-001',
                'price' => 22000,
                'stock' => 30,
                'description' => 'Croissant dengan layer butter berlapis, crispy dan renyah',
                'status' => 'active'
            ],
            [
                'name' => 'Croissant Coklat',
                'sku' => 'CRS-002',
                'price' => 25000,
                'stock' => 25,
                'description' => 'Croissant isi coklat premium, sempurna untuk camilan',
                'status' => 'active'
            ],
            [
                'name' => 'Donut Strawberry Glazed',
                'sku' => 'DNT-001',
                'price' => 12000,
                'stock' => 40,
                'description' => 'Donut rasa strawberry dengan glazed manis, lembut dan empuk',
                'status' => 'active'
            ],
            [
                'name' => 'Donut Coklat Sprinkle',
                'sku' => 'DNT-002',
                'price' => 12000,
                'stock' => 50,
                'description' => 'Donut coklat dengan sprinkle warna-warni, menarik dan lezat',
                'status' => 'active'
            ],
            [
                'name' => 'Donut Vanilla Ring',
                'sku' => 'DNT-003',
                'price' => 10000,
                'stock' => 55,
                'description' => 'Donut vanilla ring klasik, rasa vanilla yang lembut',
                'status' => 'active'
            ],
            [
                'name' => 'Baguette Prancis',
                'sku' => 'BAG-001',
                'price' => 28000,
                'stock' => 20,
                'description' => 'Baguette gaya Prancis, kulit keras renyah, dalam empuk',
                'status' => 'active'
            ],
            [
                'name' => 'Roti Pandan Spiral',
                'sku' => 'RPS-001',
                'price' => 16000,
                'stock' => 35,
                'description' => 'Roti pandan dengan spiral manis, wangi pandan alami',
                'status' => 'active'
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
