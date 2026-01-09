<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penyewa extends Model
{
    protected $table = 'penyewa';
    
    protected $fillable = [
        'nama_lengkap',
        'nomor_telepon',
        'nomor_ktp',
        'alamat_asal',
        'pekerjaan'
    ];
    
    /**
     * Relasi ke KontrakSewa
     */
    public function kontrakSewa()
    {
        return $this->hasMany(KontrakSewa::class, 'penyewa_id');
    }
    
    /**
     * Mendapatkan kontrak aktif
     */
    public function kontrakAktif()
    {
        return $this->hasMany(KontrakSewa::class, 'penyewa_id')->where('status', 'aktif');
    }
}
