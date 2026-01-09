<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// TODO: Import models yang dibutuhkan (Kamar, Penyewa, KontrakSewa, Pembayaran)

class DashboardController extends Controller
{
    public function index()
    {
        // TODO: Hitung statistik untuk dashboard:
        // - Total kamar
        // - Jumlah kamar tersedia
        // - Jumlah kamar terisi
        // - Total pendapatan bulan ini (gunakan whereMonth untuk filter)
        // - Jumlah pembayaran tertunggak
        
        // TODO: Return view 'dashboard' dengan data statistik
        // BONUS: Tambahkan data untuk chart/grafik
    }
}
