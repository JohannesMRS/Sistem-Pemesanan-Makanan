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
        Schema::create('menu', function (Blueprint $table) {
            $table->integer('id_menu')->primary()->nullable();
            $table->foreignId('id_kategori')->constrained()->onDelete('cascade');
            $table->string('nama_menu', 30);
            $table->string('deskripsi', 100);
            $table->integer('harga', 10);
            $table->integer('stok_status', 1);
            $table->string('gambar', 20);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};
