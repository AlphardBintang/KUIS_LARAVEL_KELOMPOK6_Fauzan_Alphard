<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KontrakSewa extends Model
{
    protected $table = 'kontrak_sewa';
    
    // TODO: Definisikan kolom yang dapat diisi (mass assignment)
    protected $fillable = [];
    
    // TODO: Cast kolom tanggal ke tipe date
    protected $casts = [];
    
    // TODO: Definisikan relasi ke tabel Penyewa, Kamar, dan Pembayaran
}
