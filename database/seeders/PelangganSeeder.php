<?php

namespace Database\Seeders;

use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PelangganSeeder extends Seeder
{
    public function run(): void
    {
        $daftarPelanggan = [
            [
                'username' => 'budi',
                'nama' => 'Budi Santoso',
                'no_hp' => '081234567891',
                'kode_pos' => '40123',
                'alamat' => 'Jl. Merdeka No. 12, Bandung, Jawa Barat',
            ],
            [
                'username' => 'siti',
                'nama' => 'Siti Aminah',
                'no_hp' => '081234567892',
                'kode_pos' => '10110',
                'alamat' => 'Jl. Sudirman No. 45, Jakarta Pusat, DKI Jakarta',
            ],
            [
                'username' => 'andi',
                'nama' => 'Andi Wijaya',
                'no_hp' => '081234567893',
                'kode_pos' => '60271',
                'alamat' => 'Jl. Diponegoro No. 8, Surabaya, Jawa Timur',
            ],
            [
                'username' => 'dewi',
                'nama' => 'Dewi Lestari',
                'no_hp' => '081234567894',
                'kode_pos' => '55111',
                'alamat' => 'Jl. Malioboro No. 20, Yogyakarta',
            ],
        ];

        foreach ($daftarPelanggan as $data) {
            // User dibuat lalu ID-nya langsung dipakai saat itu juga untuk
            // membuat baris pelanggan yang sesuai, jadi user_id tidak akan
            // pernah tertukar antar pelanggan walau datanya banyak.

            $user = User::firstOrCreate(
                ['username' => $data['username']],
                [
                    'name' => $data['nama'],
                    'password' => Hash::make('123'),
                    'role' => 'pelanggan',
                ]
            );

            Pelanggan::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'nama' => $data['nama'],
                    'no_hp' => $data['no_hp'],
                    'kode_pos' => $data['kode_pos'],
                    'alamat' => $data['alamat'],
                ]
            );
        }
    }
}
