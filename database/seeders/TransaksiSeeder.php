<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaksi; // Memastikan import model benar

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Transaksi Pertama
        Transaksi::create([
            'pelanggan_id' => 1,
            'tanggal_transaksi' => now(),
            'metode_pembayaran' => 'transfer',
            'total_harga' => 800000 // Diubah dari '800.000' menjadi angka murni tanpa titik
        ]);

        // 2. Transaksi Kedua
        Transaksi::create([
            'pelanggan_id' => 1,
            'tanggal_transaksi' => now()->subDays(1), // Tanggal kemarin
            'metode_pembayaran' => 'cod',
            'total_harga' => 150000
        ]);

        // 3. Transaksi Ketiga
        Transaksi::create([
            'pelanggan_id' => 1,
            'tanggal_transaksi' => now()->subDays(2), // 2 hari lalu
            'metode_pembayaran' => 'transfer',
            'total_harga' => 350000
        ]);

        // 4. Transaksi Keempat
        Transaksi::create([
            'pelanggan_id' => 1,
            'tanggal_transaksi' => now()->subDays(3), // 3 hari lalu
            'metode_pembayaran' => 'cod',
            'total_harga' => 50000
        ]);

        // 5. Transaksi Kelima
        Transaksi::create([
            'pelanggan_id' => 1,
            'tanggal_transaksi' => now()->subDays(4), // 4 hari lalu
            'metode_pembayaran' => 'transfer',
            'total_harga' => 1200000
        ]);
    }
}