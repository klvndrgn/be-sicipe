<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi', function(Blueprint $table){
            $table->increments('id_transaksi');
            $table->foreignId('id_pengguna')->constrained('pengguna');
            $table->foreignId('id_resep')->constrained('resep');
            $table->string('nama_pemilik_resep')->nullable();
            $table->string('nama_resep')->nullable();
            $table->double('harga_resep')->nullable();
            $table->double('jumlah_tagihan')->nullable();
            $table->char('status_transaksi', 4)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
