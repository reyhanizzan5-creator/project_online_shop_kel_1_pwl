<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $fillable = [
        'user_id', 
        'transaksi_id', 
        'nama', 
        'no_hp', 
        'kode_pos', 
        'alamat'];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}
