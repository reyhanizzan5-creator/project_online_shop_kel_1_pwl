<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Barang;
class Keranjang extends Model
{
    protected $fillable = [
        'barang_id', 
        'transaksi_id', 
        'jumlah', 
        'subtotal'
    ];

    protected $casts = [
        'jumlah' => 'integer',
        'subtotal' => 'integer',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    protected static function booted(): void
    {
        static::saving(function (Keranjang $keranjang) {
            $harga = $keranjang->barang?->harga
                ?? Barang::find($keranjang->barang_id)?->harga
                ?? 0;

            $keranjang->subtotal = $harga * $keranjang->jumlah;
        });
    }

    public function getSubtotalFormatAttribute(): string
    {
        return 'Rp ' . number_format((float) $this->subtotal, 0, ',', '.');
    }
}
