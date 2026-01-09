<?php

namespace App\Exports;

use App\Models\Pembayaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PembayaranExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Pembayaran::with(['kontrakSewa.penyewa', 'kontrakSewa.kamar'])
            ->orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc')
            ->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'No',
            'Nama Penyewa',
            'Nomor Kamar',
            'Bulan',
            'Tahun',
            'Jumlah Bayar',
            'Tanggal Bayar',
            'Status',
            'Keterangan'
        ];
    }

    /**
     * @param mixed $pembayaran
     * @return array
     */
    public function map($pembayaran): array
    {
        static $no = 1;
        return [
            $no++,
            $pembayaran->kontrakSewa->penyewa->nama_lengkap,
            $pembayaran->kontrakSewa->kamar->nomor_kamar,
            $pembayaran->nama_bulan,
            $pembayaran->tahun,
            $pembayaran->jumlah_bayar,
            $pembayaran->tanggal_bayar->format('d/m/Y'),
            ucfirst($pembayaran->status),
            $pembayaran->keterangan ?? '-'
        ];
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
