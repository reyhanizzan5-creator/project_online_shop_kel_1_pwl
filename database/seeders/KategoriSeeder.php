<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = [
            'Elektronik',
            'Fashion Pria',
            'Fashion Wanita',
            'Makanan & Minuman',
            'Kesehatan & Kecantikan',
            'Peralatan Rumah Tangga',
        ];

        foreach ($kategoris as $nama) {
            Kategori::firstOrCreate(['nama_kategori' => $nama]);
        }
    }
}
