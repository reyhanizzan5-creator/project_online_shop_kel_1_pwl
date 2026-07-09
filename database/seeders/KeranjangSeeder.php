<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Keranjang; // Import model Keranjang

class KeranjangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Keranjang Pertama
        Keranjang::create([
            'barang_id' => 1,
            'transaksi_id' => 1,
            'jumlah' => 2,
            'subtotal' => 50000
        ]);

        // 2. Keranjang Kedua
        Keranjang::create([
            'barang_id' => 2,
            'transaksi_id' => 1, // Masih di transaksi yang sama (transaksi 1 beli 2 barang)
            'jumlah' => 1,
            'subtotal' => 25000
        ]);

        // 3. Keranjang Ketiga
        Keranjang::create([
            'barang_id' => 3,
            'transaksi_id' => 2,
            'jumlah' => 5,
            'subtotal' => 150000
        ]);

        // 4. Keranjang Keempat
        Keranjang::create([
            'barang_id' => 1,
            'transaksi_id' => 3,
            'jumlah' => 1,
            'subtotal' => 25000
        ]);

        // 5. Keranjang Kelima
        Keranjang::create([
            'barang_id' => 4,
            'transaksi_id' => 4,
            'jumlah' => 3,
            'subtotal' => 90000
        ]);
    }
}