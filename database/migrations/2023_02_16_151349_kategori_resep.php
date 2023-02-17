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
        Schema::create('kategori_resep', function(Blueprint $table){
            $table->increments('id_kategori_resep');
            $table->string('nama_kategori_resep')->nullable();
            $table->string('foto_kategori_resep')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_resep');
    }
};
