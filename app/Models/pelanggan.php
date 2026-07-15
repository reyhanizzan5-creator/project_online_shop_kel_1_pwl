<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Pelanggan extends Model
{
    protected $fillable = [
        'user_id', 
        'transaksi_id', 
        'nama', 
        'no_hp', 
        'kode_pos', 
        'alamat'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function riwayatTransaksi()
    {
        return $this->transaksis()->where('status', '!=', 'keranjang')->latest('tanggal_transaksi');
    }

        public function keranjangAktif()
    {
        return $this->transaksis()->firstOrCreate(
            ['status' => 'keranjang'],
            [
                'tanggal_transaksi' => now(),
                'metode_pembayaran' => 'transfer',
                'total_harga' => 0,
            ]
        );
    }

    public function getJumlahItemKeranjangAttribute(): int
    {
        $keranjang = $this->transaksis()->where('status', 'keranjang')->first();

        return $keranjang ? (int) $keranjang->keranjangs()->sum('jumlah') : 0;
    }

    public static function daftarkanAkun(array $data): self
    {
        $user = User::create([
            'name' => $data['nama'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'role' => 'pelanggan',
        ]);

        return $user->pelanggan()->create([
            'nama' => $data['nama'],
            'no_hp' => $data['no_hp'],
            'kode_pos' => $data['kode_pos'],
            'alamat' => $data['alamat'],
        ]);
    }
}
