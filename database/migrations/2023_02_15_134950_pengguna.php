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
        Schema::create('pengguna', function(Blueprint $table){
            $table->increments('id_pengguna');
            $table->string('username_pengguna');
            $table->string('nama_pengguna')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->string('alamat_email')->nullable();
            $table->string('kata_sandi')->nullable();
            $table->double('sisa_saldo')->nullable();
            $table->string('nomor_rekening')->nullable();
            $table->string('photo_profile')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('pengguna');
    }
};
