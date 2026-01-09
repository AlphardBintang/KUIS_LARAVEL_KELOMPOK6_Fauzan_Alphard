<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    
    // TODO: Definisikan kolom yang dapat diisi (mass assignment)
    // BONUS: Jangan lupa tambahkan 'bukti_transfer' jika mengerjakan fitur upload
    protected $fillable = [];
    
    // TODO: Cast kolom tanggal ke tipe date
    protected $casts = [];
    
    // TODO: Definisikan relasi ke tabel KontrakSewa
}
