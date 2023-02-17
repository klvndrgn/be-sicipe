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
        Schema::create('feeds', function(Blueprint $table){
            $table->increments('id_feeds');
            $table->unsignedBigInteger('id_pengguna');
            $table->unsignedBigInteger('id_resep');
            $table->string('foto_feeds')->nullable();
            $table->string('komentar')->nullable();
            $table->string('deskripsi_feeds')->nullable();
            $table->string('nama_pengguna')->nullable();
            $table->string('nama_resep')->nullable();

            // $table->foreignId('id_pengguna')->constrained('pengguna', 'id_pengguna');
            // $table->foreignId('id_resep')->constrained('resep', 'id_resep');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feeds');
    }
};
