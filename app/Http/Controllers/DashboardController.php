<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Statistik kamar
        $totalKamar = Kamar::count();
        $kamarTerisi = Kamar::where('status', 'terisi')->count();
        $kamarTersedia = Kamar::where('status', 'tersedia')->count();

        // 2. Pendapatan bulan ini
        $pendapatanBulanIni = Pembayaran::whereMonth('tanggal_bayar', Carbon::now()->month)
            ->whereYear('tanggal_bayar', Carbon::now()->year)
            ->sum('jumlah_bayar');

        // 3. Jumlah tunggakan (pembayaran dengan status 'tertunggak')
        $jumlahTunggakan = Pembayaran::where('status', 'tertunggak')->count();

        return view('dashboard.dashboard', compact(
            'totalKamar', 
            'kamarTerisi', 
            'kamarTersedia', 
            'pendapatanBulanIni', 
            'jumlahTunggakan'
        ));
    }
}