<?php

namespace Database\Seeders;

use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            KategoriSeeder::class,
            PelangganSeeder::class,
            BarangSeeder::class,
            TransaksiSeeder::class,
            KeranjangSeeder::class
        ]);
    }
}
