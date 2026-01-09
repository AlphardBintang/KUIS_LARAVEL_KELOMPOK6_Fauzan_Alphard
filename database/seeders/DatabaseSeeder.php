<?php

namespace Database\Seeders;

use App\Models\User;
// TODO: Import models: Kamar, Penyewa, KontrakSewa, Pembayaran
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // TODO: Buat data dummy untuk testing (OPSIONAL tapi direkomendasikan)
        // Contoh struktur:
        
        // 1. Buat 10-20 kamar dengan berbagai tipe
        // Kamar::create([...])
        
        // 2. Buat 5-10 penyewa
        // Penyewa::create([...])
        
        // 3. Buat 5-8 kontrak sewa (hubungkan penyewa & kamar)
        // KontrakSewa::create([...])
        // Jangan lupa update status kamar jadi 'terisi'
        
        // 4. Buat 15-20 pembayaran (beberapa lunas, beberapa tertunggak)
        // Pembayaran::create([...])
    }
}
