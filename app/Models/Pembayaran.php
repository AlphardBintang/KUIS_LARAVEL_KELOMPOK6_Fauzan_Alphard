<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    
    protected $fillable = [
        'kontrak_sewa_id',
        'bulan',
        'tahun',
        'jumlah_bayar',
        'tanggal_bayar',
        'status',
        'keterangan'
    ];
    
    protected $casts = [
        'tanggal_bayar' => 'date',
        'jumlah_bayar' => 'decimal:2'
    ];
    
    /**
     * Relasi ke KontrakSewa
     */
    public function kontrakSewa()
    {
        return $this->belongsTo(KontrakSewa::class, 'kontrak_sewa_id');
    }
    
    /**
     * Accessor untuk nama bulan
     */
    public function getNamaBulanAttribute()
    {
        $bulan = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        
        return $bulan[$this->bulan] ?? '';
    }
}
