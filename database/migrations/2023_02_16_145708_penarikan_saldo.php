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
        Schema::create('penarikan_saldo', function(Blueprint $table){
            $table->increments('id_penarikan_saldo');
            $table->unsignedBigInteger('id_pengguna');
            $table->double('jumlah_penarikan')->nullable();
            $table->char('status_penarikan', 4)->nullable();
            $table->dateTime('tanggal_penarikan')->nullable();

            // $table->foreignId('id_pengguna')->constrained('pengguna', 'id_pengguna');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penarikan_saldo');
    }
};
