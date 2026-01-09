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

        // 4. Data untuk Chart - Pendapatan 6 bulan terakhir
        $pendapatanBulanan = [];
        $labelBulan = [];
        for ($i = 5; $i >= 0; $i--) {
            $tanggal = Carbon::now()->subMonths($i);
            $bulan = $tanggal->month;
            $tahun = $tanggal->year;
            
            $pendapatan = Pembayaran::whereMonth('tanggal_bayar', $bulan)
                ->whereYear('tanggal_bayar', $tahun)
                ->sum('jumlah_bayar');
            
            $pendapatanBulanan[] = (float) $pendapatan;
            $labelBulan[] = $tanggal->format('M Y');
        }

        // 5. Data untuk Chart - Status Pembayaran
        $pembayaranLunas = Pembayaran::where('status', 'lunas')->count();
        $pembayaranTertunggak = Pembayaran::where('status', 'tertunggak')->count();

        // 6. Data untuk Chart - Tipe Kamar
        $kamarStandard = Kamar::where('tipe', 'standard')->count();
        $kamarDeluxe = Kamar::where('tipe', 'deluxe')->count();
        $kamarVip = Kamar::where('tipe', 'vip')->count();

        return view('dashboard.dashboard', compact(
            'totalKamar', 
            'kamarTerisi', 
            'kamarTersedia', 
            'pendapatanBulanIni', 
            'jumlahTunggakan',
            'pendapatanBulanan',
            'labelBulan',
            'pembayaranLunas',
            'pembayaranTertunggak',
            'kamarStandard',
            'kamarDeluxe',
            'kamarVip'
        ));
    }
}