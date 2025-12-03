<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = \App\Models\Product::all();
        
        if ($products->isEmpty()) {
            $this->command->error('Tidak ada produk di database. Silakan tambahkan produk terlebih dahulu.');
            return;
        }

        // Daftar nama pembeli Indonesia
        $buyerNames = [
            'Budi Santoso', 'Siti Nurhaliza', 'Ahmad Fauzi', 'Dewi Lestari', 'Rudi Hartono',
            'Maya Sari', 'Andi Wijaya', 'Rina Kusuma', 'Hendra Gunawan', 'Fitri Handayani',
            'Agus Setiawan', 'Lina Marlina', 'Dedi Kurniawan', 'Wati Suryani', 'Bambang Pamungkas',
            'Yuni Shara', 'Tono Suratman', 'Eka Putri', 'Joko Widodo', 'Sri Mulyani',
            'Adi Nugroho', 'Ratna Sari', 'Fajar Ramadhan', 'Indah Permata', 'Wahyu Hidayat',
            'Sari Dewi', 'Rizki Pratama', 'Dian Sastro', 'Arief Rahman', 'Putri Ayu',
            'Bayu Setiawan', 'Mega Wati', 'Irfan Hakim', 'Nisa Sabyan', 'Dimas Anggara'
        ];

        $this->command->info('Membuat 35 data penjualan dummy...');

        for ($i = 0; $i < 35; $i++) {
            $product = $products->random();
            $quantity = rand(1, 5);
            $price = $product->price;
            
            \App\Models\Sale::create([
                'product_id' => $product->id,
                'quantity' => $quantity,
                'total_price' => $price * $quantity,
                'buyer_name' => $buyerNames[$i],
                'status' => rand(0, 10) > 1 ? 'completed' : 'cancelled', // 90% completed
                'created_at' => now()->subDays(rand(0, 30))->subHours(rand(0, 23)),
            ]);
        }

        $this->command->info('✅ Berhasil membuat 35 data penjualan!');
    }
}
