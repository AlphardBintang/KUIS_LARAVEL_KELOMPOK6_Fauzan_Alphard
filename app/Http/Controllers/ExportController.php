<?php

namespace App\Http\Controllers;

use App\Exports\PembayaranExport;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportController extends Controller
{
    /**
     * Export data pembayaran ke Excel
     */
    public function exportExcel()
    {
        $filename = 'Laporan_Pembayaran_' . date('Y-m-d_His') . '.xlsx';
        return Excel::download(new PembayaranExport, $filename);
    }

    /**
     * Export data pembayaran ke PDF
     */
    public function exportPdf()
    {
        $pembayarans = Pembayaran::with(['kontrakSewa.penyewa', 'kontrakSewa.kamar'])
            ->orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc')
            ->get();

        $pdf = Pdf::loadView('exports.pembayaran-pdf', compact('pembayarans'));
        $filename = 'Laporan_Pembayaran_' . date('Y-m-d_His') . '.pdf';
        
        return $pdf->download($filename);
    }
}
