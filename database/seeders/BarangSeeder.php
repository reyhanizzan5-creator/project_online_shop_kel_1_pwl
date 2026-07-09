<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Barang; // Memastikan import model benar

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Barang Pertama (Kategori: Makanan / ID: 1)
        Barang::create([
            'nama_barang' => 'Mie Instan Goreng',
            'kategori_id' => 1,
            'gambar' => 'mie_goreng.jpg',
            'harga' => 3000, // Angka murni tanpa titik dan tanda petik
            'stok' => 50
        ]);

        // 2. Barang Kedua (Kategori: Makanan / ID: 1)
        Barang::create([
            'nama_barang' => 'Kripik Singkong',
            'kategori_id' => 1,
            'gambar' => 'kripik_singkong.jpg',
            'harga' => 12000,
            'stok' => 30
        ]);

        // 3. Barang Ketiga (Kategori: Minuman / ID: 2)
        Barang::create([
            'nama_barang' => 'Kopi Susu Botol',
            'kategori_id' => 2,
            'gambar' => 'kopi_susu.jpg',
            'harga' => 8000,
            'stok' => 40
        ]);

        // 4. Barang Keempat (Kategori: Elektronik / ID: 4)
        Barang::create([
            'nama_barang' => 'Mouse Wireless',
            'kategori_id' => 4,
            'gambar' => 'mouse_wireless.jpg',
            'harga' => 150000,
            'stok' => 15
        ]);

        // 5. Barang Kelima (Kategori: Pakaian / ID: 3)
        Barang::create([
            'nama_barang' => 'Kaos Polos Hitam XL',
            'kategori_id' => 3,
            'gambar' => 'kaos_hitam.jpg',
            'harga' => 65000,
            'stok' => 25
        ]);
    }
}