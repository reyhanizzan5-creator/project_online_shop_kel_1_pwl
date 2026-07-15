<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'pelanggan_id', 
        'tanggal_transaksi', 
        'metode_pembayaran', 
        'status',
        'total_harga'
    ];

    protected $casts = [
        'tanggal_transaksi' => 'date',
        'total_harga' => 'integer',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function keranjangs()
    {
        return $this->hasMany(Keranjang::class);
    }

    public function hitungTotal(): int
    {
        $total = (int) $this->keranjangs()->sum('subtotal');
        $this->update(['total_harga' => $total]);

        return $total;
    }

    public function getTotalHargaFormatAttribute(): string
    {
        return 'Rp ' . number_format((float) $this->total_harga, 0, ',', '.');
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'keranjang' => 'Keranjang',
            'diproses' => 'Diproses',
            'dikirim' => 'Dikirim',
            'selesai' => 'Selesai',
            'dibatalkan' => 'Dibatalkan',
            default => ucfirst($this->status),
        };
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'keranjang' => 'badge badge-gray',
            'diproses' => 'badge badge-blue',
            'dikirim' => 'badge badge-yellow',
            'selesai' => 'badge badge-green',
            'dibatalkan' => 'badge badge-red',
            default => 'badge badge-gray',
        };
    }

    public function scopeRiwayat($query)
    {
        return $query->where('status', '!=', 'keranjang');
    }
}
