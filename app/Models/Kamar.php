<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamar';
    
    protected $fillable = [
        'nomor_kamar',
        'tipe',
        'harga_bulanan',
        'fasilitas',
        'status'
    ];
    
    /**
     * Relasi ke KontrakSewa
     */
    public function kontrakSewa()
    {
        return $this->hasMany(KontrakSewa::class, 'kamar_id');
    }
    
    /**
     * Mendapatkan kontrak aktif
     */
    public function kontrakAktif()
    {
        return $this->hasMany(KontrakSewa::class, 'kamar_id')->where('status', 'aktif');
    }
}
