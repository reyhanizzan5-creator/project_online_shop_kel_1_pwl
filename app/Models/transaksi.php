<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = ['pelanggan_id', 'keranjang_id', 'tanggal_transaksi', 'metode_pembayaran', 'total_harga'];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function keranjangs()
    {
        return $this->hasMany(Keranjang::class);
    }
}
