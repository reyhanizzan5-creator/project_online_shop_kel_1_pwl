<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelanggan_id')->constrained('pelanggans')->onDelete('cascade');
            $table->date('tanggal_transaksi');
            $table->enum('metode_pembayaran', ['transfer', 'cod'])->default('transfer');
            $table->enum('status', ['keranjang', 'diproses', 'dikirim', 'selesai', 'dibatalkan'])->default('keranjang');
            $table->integer('total_harga')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
