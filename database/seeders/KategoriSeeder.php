<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori; // Memastikan import model benar

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Kategori Pertama
        Kategori::create([
            'nama_kategori' => 'Makanan'
        ]);

        // 2. Kategori Kedua
        Kategori::create([
            'nama_kategori' => 'Minuman'
        ]);

        // 3. Kategori Ketiga
        Kategori::create([
            'nama_kategori' => 'Pakaian'
        ]);

        // 4. Kategori Keempat
        Kategori::create([
            'nama_kategori' => 'Elektronik'
        
        ]);
    }
}