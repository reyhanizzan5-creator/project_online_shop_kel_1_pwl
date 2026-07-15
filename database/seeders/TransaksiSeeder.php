<?php

namespace Database\Seeders;

use App\Models\Pelanggan;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        $daftarTransaksi = [
            ['username' => 'budi', 'status' => 'selesai',    'metode_pembayaran' => 'transfer', 'hari_lalu' => 5],
            ['username' => 'budi', 'status' => 'diproses',   'metode_pembayaran' => 'cod',       'hari_lalu' => 1],
            ['username' => 'siti', 'status' => 'dikirim',    'metode_pembayaran' => 'transfer', 'hari_lalu' => 3],
            ['username' => 'andi', 'status' => 'dibatalkan', 'metode_pembayaran' => 'cod',       'hari_lalu' => 7],
            ['username' => 'dewi', 'status' => 'keranjang',  'metode_pembayaran' => 'transfer', 'hari_lalu' => 0],
        ];

        foreach ($daftarTransaksi as $data) {
            $user = User::where('username', $data['username'])->first();

            if (! $user) {
                continue;
            }

            $pelanggan = Pelanggan::where('user_id', $user->id)->first();

            if (! $pelanggan) {
                continue;
            }

            $sudahAda = Transaksi::where('pelanggan_id', $pelanggan->id)
                ->where('status', $data['status'])
                ->exists();

            if ($sudahAda) {
                continue;
            }

            Transaksi::create([
                'pelanggan_id' => $pelanggan->id,
                'tanggal_transaksi' => now()->subDays($data['hari_lalu'])->toDateString(),
                'metode_pembayaran' => $data['metode_pembayaran'],
                'status' => $data['status'],
                'total_harga' => 0,
            ]);
        }
    }
}
