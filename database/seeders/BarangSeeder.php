<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Setiap barang diikat ke kategori_id milik kategori yang sudah dibuat
     * oleh KategoriSeeder, dicari lewat nama_kategori-nya.
     */
    public function run(): void
    {
        $data = [
            'Elektronik' => [
                ['Headset Bluetooth JBL Tune 510BT', 450000, 25],
                ['Power Bank 20000mAh Fast Charging', 275000, 40],
                ['Speaker Portable Advance', 185000, 30],
                ['Kabel Data USB-C Fast Charging', 45000, 100],
            ],
            'Fashion Pria' => [
                ['Kemeja Flanel Lengan Panjang', 120000, 50],
                ['Celana Chino Slim Fit', 165000, 35],
                ['Jaket Bomber Pria', 210000, 20],
            ],
            'Fashion Wanita' => [
                ['Blouse Wanita Katun Premium', 95000, 45],
                ['Rok Plisket Midi', 110000, 30],
                ['Tas Selempang Wanita', 175000, 25],
            ],
            'Makanan & Minuman' => [
                ['Kopi Robusta Gayo 250gr', 65000, 60],
                ['Keripik Singkong Balado 200gr', 18000, 150],
                ['Madu Hutan Asli 500ml', 95000, 40],
                ['Teh Celup Herbal isi 25', 22000, 80],
            ],
            'Kesehatan & Kecantikan' => [
                ['Hand Sanitizer 500ml', 25000, 100],
                ['Sheet Mask Wajah isi 5', 35000, 70],
                ['Vitamin C 1000mg isi 30 Tablet', 55000, 45],
            ],
            'Peralatan Rumah Tangga' => [
                ['Rak Serbaguna 3 Susun', 145000, 20],
                ['Toples Set Kedap Udara isi 3', 85000, 30],
                ['Sapu & Pengki Set', 55000, 40],
                ['Lampu LED Hemat Energi 12W', 32000, 90],
            ],
        ];

        foreach ($data as $namaKategori => $daftarBarang) {
            $kategori = Kategori::where('nama_kategori', $namaKategori)->first();

            if (! $kategori) {
                continue;
            }

            foreach ($daftarBarang as [$nama, $harga, $stok]) {
                Barang::firstOrCreate(
                    ['nama_barang' => $nama],
                    ['kategori_id' => $kategori->id, 'harga' => $harga, 'stok' => $stok]
                );
            }
        }
    }
}
