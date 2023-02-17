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
        Schema::create('top_up', function(Blueprint $table){
            $table->increments('id_top_up');
            $table->foreignId('id_pengguna')->constrained('pengguna');
            $table->double('jumlah_top_up')->nullable();
            $table->char('status_top_up', '4')->nullable();
            $table->dateTime('tanggal_top_up')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('top_up');
    }
};
