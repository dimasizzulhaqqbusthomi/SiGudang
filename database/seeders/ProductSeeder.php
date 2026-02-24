<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Supplier;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua ID supplier yang ada untuk relasi
        $supplierIds = Supplier::pluck('id_supplier')->toArray();

        // Jika tabel supplier kosong, seeder tidak akan berjalan untuk menghindari error foreign key
        if (empty($supplierIds)) {
            $this->command->warn("Data Supplier kosong! Silakan isi tabel suppliers terlebih dahulu.");
            return;
        }

        $products = [
            // Kategori: Makanan
            ['name_product' => 'Beras Pandan Wangi 5kg', 'description' => 'Beras kualitas super pulen', 'stock' => 50, 'price' => 75000],
            ['name_product' => 'Minyak Goreng 2L', 'description' => 'Minyak kelapa sawit jernih', 'stock' => 100, 'price' => 34000],
            ['name_product' => 'Gula Pasir 1kg', 'description' => 'Gula kristal putih tebu asli', 'stock' => 80, 'price' => 16000],
            ['name_product' => 'Mie Instan Goreng (Karton)', 'description' => 'Isi 40 bungkus mie goreng', 'stock' => 20, 'price' => 115000],
            ['name_product' => 'Susu Kental Manis', 'description' => 'Kaleng isi 370g', 'stock' => 60, 'price' => 12000],
            ['name_product' => 'Kopi Bubuk Robusta 250g', 'description' => 'Kopi murni Lampung', 'stock' => 45, 'price' => 25000],
            ['name_product' => 'Teh Celup Kotak', 'description' => 'Isi 25 kantong teh melati', 'stock' => 150, 'price' => 6500],
            ['name_product' => 'Kecap Manis Botol Besar', 'description' => 'Kecap kedelai hitam pilihan', 'stock' => 30, 'price' => 22000],
            ['name_product' => 'Garam Beryodium', 'description' => 'Garam dapur halus isi 500g', 'stock' => 200, 'price' => 3000],
            ['name_product' => 'Sereal Cokelat 500g', 'description' => 'Menu sarapan bergizi', 'stock' => 25, 'price' => 45000],

            // Kategori: Perabotan Rumah
            ['name_product' => 'Wajan Anti Lengket', 'description' => 'Diameter 24cm teflon coating', 'stock' => 15, 'price' => 150000],
            ['name_product' => 'Sapu Lantai Nilon', 'description' => 'Gagang kayu kuat dan awet', 'stock' => 40, 'price' => 25000],
            ['name_product' => 'Panci Stainless Steel', 'description' => 'Ukuran sedang 3 liter', 'stock' => 10, 'price' => 85000],
            ['name_product' => 'Set Pisau Dapur', 'description' => 'Isi 5 pcs berbagai ukuran', 'stock' => 12, 'price' => 120000],
            ['name_product' => 'Pel Lantai Mikrofiber', 'description' => 'Daya serap tinggi dan praktis', 'stock' => 25, 'price' => 55000],
            ['name_product' => 'Rak Piring Plastik', 'description' => 'Susun 2 dengan nampan air', 'stock' => 8, 'price' => 65000],
            ['name_product' => 'Botol Minum 1L', 'description' => 'BPA Free bahan food grade', 'stock' => 60, 'price' => 35000],
            ['name_product' => 'Lampu LED 12 Watt', 'description' => 'Cahaya putih hemat energi', 'stock' => 100, 'price' => 40000],
            ['name_product' => 'Tempat Sampah Injak', 'description' => 'Kapasitas 10 liter plastik tebal', 'stock' => 20, 'price' => 45000],
            ['name_product' => 'Keset Kaki Memory Foam', 'description' => 'Sangat lembut dan menyerap air', 'stock' => 35, 'price' => 30000],
        ];

        foreach ($products as $item) {
            DB::table('products')->insert([
                'name_product' => $item['name_product'],
                'description'  => $item['description'],
                'stock'        => $item['stock'],
                'price'        => $item['price'],
                'id_supplier'  => $supplierIds[array_rand($supplierIds)], // Pilih ID supplier secara acak
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }
    }
}