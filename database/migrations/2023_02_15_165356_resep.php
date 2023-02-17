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
        //
        Schema::create('resep', function (Blueprint $table){
            $table->increments('id_resep');
            $table->unsignedBigInteger('id_pengguna');
            $table->unsignedBigInteger('id_kategori_resep');
            $table->string('nama_kategori_resep')->nullable();
            $table->string('nama_resep')->nullable();
            $table->double('harga_resep')->nullable();
            $table->text('bahan_dan_alat')->nullable();
            $table->text('cara_kerja')->nullable();
            $table->string('durasi_masak')->nullable();
            $table->string('jumlah_kalori')->nullable();
            $table->text('deskripsi_resep')->nullable();
            $table->string('foto_resep')->nullable();

            // $table->foreign('id_pengguna')->references('id_pengguna')->on('pengguna');
            // $table->foreign('id_kategori_resep')->references('id_kategori_resep')->on('kategori_resep');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resep');
    }
};
