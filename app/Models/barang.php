<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'nama_barang', 
        'kategori_id', 
        'harga', 
        'stok', 
        'gambar',
        'profil'
    ];

    protected $casts = [
        'harga' => 'integer',
        'stok' => 'integer',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class);
    }

    public function getHargaFormatAttribute(): string
    {
        return 'Rp ' . number_format((float) $this->harga, 0, ',', '.');
    }

    public function getGambarUrlAttribute(): string
    {
        if (!$this->gambar) {
            return asset('images/no-image.svg');
        }

        if (filter_var($this->gambar, FILTER_VALIDATE_URL)) {
            return $this->gambar;
        }

        if (file_exists(public_path('images/barang/' . $this->gambar))) {

            return asset('images/barang/' . $this->gambar);
        }

        return asset('images/no-image.svg');
    }

    public function getStokMenipisAttribute(): bool
    {
        return $this->stok <= 5;
    }

    public function scopeCari($query, ?string $keyword)
    {
        if (filled($keyword)) {
            $query->where('nama_barang', 'like', '%' . $keyword . '%');
        }

        return $query;
    }
}
