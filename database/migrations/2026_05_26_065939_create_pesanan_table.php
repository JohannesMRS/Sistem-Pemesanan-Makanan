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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->integer('id_pesanan')->primary()->nullable();
            $table->integer('nomor_meja');
            $table->timestamp('tanggal_jam', 6);
            $table->string('tipe_pesanan', 10);
            $table->integer('total_harga');
            $table->string('status_pesanan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
