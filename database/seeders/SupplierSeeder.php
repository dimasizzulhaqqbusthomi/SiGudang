<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = [
            ['nama_supplier' => 'PT. Teknologi Nusantara', 'alamat_supplier' => 'Jl. Industri Raya No. 12, Jakarta Pusat', 'no_telp_supplier' => '021-5550101'],
            ['nama_supplier' => 'CV. Sumber Makmur', 'alamat_supplier' => 'Jl. Ahmad Yani No. 45, Surabaya', 'no_telp_supplier' => '031-7770202'],
            ['nama_supplier' => 'PT. Logistik Jaya', 'alamat_supplier' => 'Kawasan Industri Jababeka Blok C, Bekasi', 'no_telp_supplier' => '021-8880303'],
            ['nama_supplier' => 'Global Elektronik', 'alamat_supplier' => 'Mangga Dua Mall Lt. 3, Jakarta Barat', 'no_telp_supplier' => '021-4440404'],
            ['nama_supplier' => 'PT. Sarana Abadi', 'alamat_supplier' => 'Jl. Gajah Mada No. 88, Semarang', 'no_telp_supplier' => '024-3330505'],
            ['nama_supplier' => 'CV. Mitra Sejahtera', 'alamat_supplier' => 'Jl. Diponegoro No. 10, Bandung', 'no_telp_supplier' => '022-2220606'],
            ['nama_supplier' => 'PT. Inti Persada', 'alamat_supplier' => 'Jl. Sudirman Kav. 52, Jakarta Selatan', 'no_telp_supplier' => '021-1110707'],
            ['nama_supplier' => 'Mandiri Peralatan', 'alamat_supplier' => 'Jl. Pahlawan No. 22, Medan', 'no_telp_supplier' => '061-9990808'],
            ['nama_supplier' => 'PT. Artha Graha Logistik', 'alamat_supplier' => 'Jl. Bypass Ngurah Rai, Denpasar', 'no_telp_supplier' => '0361-4440909'],
            ['nama_supplier' => 'CV. Cahaya Baru', 'alamat_supplier' => 'Jl. Malioboro No. 100, Yogyakarta', 'no_telp_supplier' => '0274-5551010'],
            ['nama_supplier' => 'PT. Prima Distribusi', 'alamat_supplier' => 'Kawasan SIER Rungkut, Surabaya', 'no_telp_supplier' => '031-8881111'],
            ['nama_supplier' => 'Indo Hardware', 'alamat_supplier' => 'Jl. Raden Saleh No. 5, Palembang', 'no_telp_supplier' => '0711-3331212'],
            ['nama_supplier' => 'PT. Kencana Unggul', 'alamat_supplier' => 'Jl. Pemuda No. 17, Makassar', 'no_telp_supplier' => '0411-2221313'],
            ['nama_supplier' => 'CV. Galaksi Digital', 'alamat_supplier' => 'Ruko ITC Fatmawati Blok D, Jakarta Selatan', 'no_telp_supplier' => '021-7771414'],
            ['nama_supplier' => 'PT. Sinar Terang', 'alamat_supplier' => 'Jl. Veteran No. 30, Malang', 'no_telp_supplier' => '0341-4441515'],
            ['nama_supplier' => 'Duta Komputer', 'alamat_supplier' => 'Plaza Simpang Lima, Semarang', 'no_telp_supplier' => '024-6661616'],
            ['nama_supplier' => 'PT. Berkat Niaga', 'alamat_supplier' => 'Jl. Asia Afrika No. 120, Bandung', 'no_telp_supplier' => '022-7771717'],
            ['nama_supplier' => 'CV. Delta Pratama', 'alamat_supplier' => 'Kawasan Industri Terboyo, Semarang', 'no_telp_supplier' => '024-8881818'],
            ['nama_supplier' => 'PT. Eka Jaya Mandiri', 'alamat_supplier' => 'Jl. Gatot Subroto No. 9, Banjarmasin', 'no_telp_supplier' => '0511-9991919'],
            ['nama_supplier' => 'Sentra Supplier Indo', 'alamat_supplier' => 'Perum Green Lake City Blok B, Tangerang', 'no_telp_supplier' => '021-3332020'],
        ];

        foreach ($suppliers as $supplier) {
            DB::table('suppliers')->insert(array_merge($supplier, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}