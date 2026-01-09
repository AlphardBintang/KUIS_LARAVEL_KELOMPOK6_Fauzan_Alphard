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
        Schema::create('kontrak_sewa', function (Blueprint $table) {
            $table->id();
            
            // TODO: Tambahkan kolom-kolom sesuai requirements:
            // - penyewa_id: foreignId() ke tabel penyewa (gunakan constrained()->cascadeOnDelete())
            // - kamar_id: foreignId() ke tabel kamar (gunakan constrained()->cascadeOnDelete())
            // - tanggal_mulai: date
            // - tanggal_selesai: date
            // - harga_bulanan: decimal(10,2)
            // - status: enum('aktif', 'selesai'), default 'aktif'
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontrak_sewa');
    }
};
