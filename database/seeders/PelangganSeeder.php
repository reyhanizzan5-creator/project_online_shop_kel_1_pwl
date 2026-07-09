<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pelanggan; // Import model Pelanggan

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Pelanggan Pertama (Nyambung ke User ID 1)
        Pelanggan::create([
            'user_id' => 1,
            'nama' => 'Udin Saputra',
            'no_hp' => '0878678291',
            'kode_pos' => '22553',
            'alamat' => 'Jl. Mawar No. 12'
        ]);

        // 2. Pelanggan Kedua (Nyambung ke User ID 2)
        Pelanggan::create([
            'user_id' => 2,
            'nama' => 'Budi Setiawan',
            'no_hp' => '081234567',
            'kode_pos' => '12345',
            'alamat' => 'Jl. Melati No. 5'
        ]);

        // 3. Pelanggan Ketiga (Nyambung ke User ID 3)
        Pelanggan::create([
            'user_id' => 3,
            'nama' => 'Siti Aminah',
            'no_hp' => '0857112',
            'kode_pos' => '54321',
            'alamat' => 'Jl. Anggrek No. 88'
        ]);

        // 4. Pelanggan Keempat (Nyambung ke User ID 4)
        Pelanggan::create([
            'user_id' => 4,
            'nama' => 'Iwan Kurniawan',
            'no_hp' => '08998877',
            'kode_pos' => '45678',
            'alamat' => 'Jl. Kamboja No. 3'
        ]);

        // 5. Pelanggan Kelima (Nyambung ke User ID 5)
        Pelanggan::create([
            'user_id' => 5,
            'nama' => 'Sari Wijaya',
            'no_hp' => '082199887',
            'kode_pos' => '98765',
            'alamat' => 'Jl. Dahlia No. 17'
        ]);
    }
}