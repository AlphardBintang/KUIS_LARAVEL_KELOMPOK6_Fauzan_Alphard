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
        Schema::create('kamar', function (Blueprint $table) {
            $table->id();
            
            // TODO: Tambahkan kolom-kolom sesuai requirements:
            // - nomor_kamar: string(10), unique, contoh: "A1", "B2"
            // - tipe: enum('standard', 'deluxe', 'vip')
            // - harga_bulanan: decimal(10,2)
            // - fasilitas: text (deskripsi fasilitas AC, WiFi, dll)
            // - status: enum('tersedia', 'terisi'), default 'tersedia'
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamar');
    }
};
