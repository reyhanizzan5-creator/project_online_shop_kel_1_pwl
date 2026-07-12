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
        Pelanggan::create([
            'user_id' => 1,
            'nama' => 'John Doe',
            'no_hp' => '0878678291',
            'kode_pos' => '22553',
            'alamat' => 'Jl. Mawar No. 12'
        ]);
    }
}