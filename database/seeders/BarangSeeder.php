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
                ['Headset Bluetooth JBL Tune 510BT', 450000, 25, 'https://i.ibb.co.com/1Gs9XW9s/jbl-tune-510-bt-wireless-headphones.webp'],
                ['Power Bank 20000mAh Fast Charging', 275000, 40, 'https://i.ebayimg.com/thumbs/images/g/M5wAAeSwCfFpgCz1/s-l500.jpg'],
                ['Speaker Portable Advance', 185000, 30, 'https://th.bing.com/th/id/OIP.17QGvknh--irNsV--SlAmQHaHa?w=216&h=216&c=7&r=0&o=7&pid=1.7&rm=3'],
                ['Kabel Data USB-C Fast Charging', 45000, 100,'https://th.bing.com/th/id/OIP.L_C14Phe9xx0Nlot6lut_AHaHa?w=216&h=216&c=7&r=0&o=7&pid=1.7&rm=3'],
            ],
            'Fashion Pria' => [
                ['Kemeja Flanel Lengan Panjang', 120000, 50, 'https://th.bing.com/th/id/OIP.jMxLznjJxnpZfpaUa8cnJwHaHa?w=216&h=216&c=7&r=0&o=7&pid=1.7&rm=3'],
                ['Celana Chino Slim Fit', 165000, 35, 'https://th.bing.com/th/id/OIP.sev9yH82f_fz_htI91gxRgHaHa?w=211&h=211&c=7&r=0&o=7&pid=1.7&rm=3'],
                ['Jaket Bomber Pria', 210000, 20, 'https://th.bing.com/th/id/OIP.6LmvD9dl3kCd8iVpo3Z5_wHaHa?w=216&h=216&c=7&r=0&o=7&pid=1.7&rm=3'],
            ],
            'Fashion Wanita' => [
                ['Blouse Wanita Katun Premium', 95000, 45, 'https://th.bing.com/th/id/OIP.opzwL40Efu_JvcN8mpRgygHaHa?w=196&h=196&c=7&r=0&o=7&pid=1.7&rm=3'],
                ['Rok Plisket Midi', 110000, 30, 'https://th.bing.com/th/id/OIP.j3dZzOlTc1KobkFXqRUSmQHaHa?w=195&h=194&c=7&r=0&o=7&pid=1.7&rm=3'],
                ['Tas Selempang Wanita', 175000, 25, 'https://th.bing.com/th/id/OIP.P1sfy-M-6ejPaPLKbKYwSAHaHa?w=186&h=186&c=7&r=0&o=7&pid=1.7&rm=3'],
            ],
            'Makanan & Minuman' => [
                ['Kopi Robusta Gayo 250gr', 65000, 60, 'https://th.bing.com/th/id/OIP.eIiOzF5_KIqV68vk77CzPQHaHa?w=186&h=186&c=7&r=0&o=7&pid=1.7&rm=3'],
                ['Keripik Singkong Balado 200gr', 18000, 150, 'https://th.bing.com/th/id/OIP.W5KSi6753Qim0NUQwVIcPwHaHa?w=165&h=180&c=7&r=0&o=7&pid=1.7&rm=3'],
                ['Madu Hutan Asli 500ml', 95000, 40, 'https://th.bing.com/th/id/OIP.1Dj0Xc5PUaVjAO2NZh9wTAHaHa?w=186&h=186&c=7&r=0&o=7&pid=1.7&rm=3'],
                ['Teh Celup Herbal isi 25', 22000, 80, 'https://th.bing.com/th/id/OIP._5AeJZ3hpzY3qRhTgqXezAHaHa?w=186&h=186&c=7&r=0&o=7&pid=1.7&rm=3'],
            ],
            'Kesehatan & Kecantikan' => [
                ['Hand Sanitizer 500ml', 25000, 100, 'https://th.bing.com/th/id/OIP.DOCldjx6i8jqQZYKomBODQHaHa?w=176&h=180&c=7&r=0&o=7&pid=1.7&rm=3'],
                ['Sheet Mask Wajah isi 5', 35000, 70, 'https://th.bing.com/th/id/OIP.Stac8NrINPr1sRBSXAGjiwHaHa?w=186&h=186&c=7&r=0&o=7&pid=1.7&rm=3'],
                ['Vitamin C 1000mg isi 30 Tablet', 55000, 45, 'https://th.bing.com/th/id/OIP.Dwl95BNLUJSHwrDFWvA3HwHaHa?w=186&h=186&c=7&r=0&o=7&pid=1.7&rm=3'],
            ],
            'Peralatan Rumah Tangga' => [
                ['Rak Serbaguna 3 Susun', 145000, 20, 'https://th.bing.com/th/id/OIP.7hZtQJTkxke-Nce3hJVGjQHaHa?w=199&h=199&c=7&r=0&o=7&pid=1.7&rm=3'],
                ['Toples Set Kedap Udara isi 3', 85000, 30, 'https://th.bing.com/th/id/OIP.nqqBUoaSJF7SEk51GiHUAAHaHa?w=186&h=186&c=7&r=0&o=7&pid=1.7&rm=3'],
                ['Sapu & Pengki Set', 55000, 40, 'https://th.bing.com/th/id/OIP.Z6eXyFoSoWA-kQdHs46chgHaHa?w=186&h=186&c=7&r=0&o=7&pid=1.7&rm=3'],
                ['Lampu LED Hemat Energi 10W', 32000, 90, 'https://th.bing.com/th/id/OIP._CmeXbwRiqXHjos_8MTkWQHaHa?w=186&h=186&c=7&r=0&o=7&pid=1.7&rm=3'],
            ],
        ];

        foreach ($data as $namaKategori => $daftarBarang) {
            $kategori = Kategori::where('nama_kategori', $namaKategori)->first();

            if (! $kategori) {
                continue;
            }

            foreach ($daftarBarang as [$nama, $harga, $stok, $gambar_url]) {
                Barang::firstOrCreate(
                    ['nama_barang' => $nama],
                    ['kategori_id' => $kategori->id, 'harga' => $harga, 'stok' => $stok, 'gambar' => $gambar_url]
                );
            }
        }
    }
}
