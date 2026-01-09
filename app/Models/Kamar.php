<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamars';
    protected $fillable = [
        'nomor_kamar',
        'tipe',
        'harga_bulanan',
        'fasilitas',
        'status',
    ];

    public function kontrakSewa()
    {
        return $this->hasMany(KontrakSewa::class);
    }
}
