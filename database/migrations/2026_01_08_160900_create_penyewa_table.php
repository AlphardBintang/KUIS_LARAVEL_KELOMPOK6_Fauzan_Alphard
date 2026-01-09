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
        Schema::create('penyewa', function (Blueprint $table) {
            $table->id();
            
            // TODO: Tambahkan kolom-kolom sesuai requirements:
            // - nama_lengkap: string(100)
            // - nomor_telepon: string(15)
            // - nomor_ktp: string(20), unique
            // - alamat_asal: text (alamat KTP)
            // - pekerjaan: string(50), contoh: Mahasiswa, Karyawan, dll
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyewa');
    }
};
