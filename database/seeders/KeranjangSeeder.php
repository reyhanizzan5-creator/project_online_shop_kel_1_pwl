<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\Keranjang;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Database\Seeder;

class KeranjangSeeder extends Seeder
{
    public function run(): void
    {
        $daftarIsiKeranjang = [
            [
                'username' => 'budi', 'status' => 'selesai',
                'items' => [
                    ['barang' => 'Headset Bluetooth JBL Tune 510BT', 'jumlah' => 1],
                    ['barang' => 'Kabel Data USB-C Fast Charging', 'jumlah' => 2],
                ],
            ],
            [
                'username' => 'budi', 'status' => 'diproses',
                'items' => [
                    ['barang' => 'Kopi Robusta Gayo 250gr', 'jumlah' => 2],
                    ['barang' => 'Keripik Singkong Balado 200gr', 'jumlah' => 3],
                ],
            ],
            [
                'username' => 'siti', 'status' => 'dikirim',
                'items' => [
                    ['barang' => 'Blouse Wanita Katun Premium', 'jumlah' => 1],
                    ['barang' => 'Rok Plisket Midi', 'jumlah' => 1],
                ],
            ],
            [
                'username' => 'andi', 'status' => 'dibatalkan',
                'items' => [
                    ['barang' => 'Jaket Bomber Pria', 'jumlah' => 1],
                ],
            ],
            [
                'username' => 'dewi', 'status' => 'keranjang',
                'items' => [
                    ['barang' => 'Sheet Mask Wajah isi 5', 'jumlah' => 2],
                    ['barang' => 'Vitamin C 1000mg isi 30 Tablet', 'jumlah' => 1],
                ],
            ],
        ];

        foreach ($daftarIsiKeranjang as $data) {
            $user = User::where('username', $data['username'])->first();
            $pelanggan = $user ? Pelanggan::where('user_id', $user->id)->first() : null;

            if (! $pelanggan) {
                continue;
            }

            $transaksi = Transaksi::where('pelanggan_id', $pelanggan->id)
                ->where('status', $data['status'])
                ->first();

            if (! $transaksi || Keranjang::where('transaksi_id', $transaksi->id)->exists()) {
                continue;
            }

            $totalHarga = 0;

            foreach ($data['items'] as $item) {
                $barang = Barang::where('nama_barang', $item['barang'])->first();

                if (! $barang) {
                    continue;
                }

                $subtotal = $barang->harga * $item['jumlah'];
                $totalHarga += $subtotal;

                Keranjang::create([
                    'barang_id' => $barang->id,
                    'transaksi_id' => $transaksi->id,
                    'jumlah' => $item['jumlah'],
                    'subtotal' => $subtotal,
                ]);
            }

            $transaksi->update(['total_harga' => $totalHarga]);
        }
    }
}
