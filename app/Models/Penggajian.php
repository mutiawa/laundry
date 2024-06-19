<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\NumberFormatter;

class Penggajian extends Model
{
    use HasFactory;
    protected $table = 'penggajian';

    protected $fillable = [
        'nama_pegawai',
        'kehadiran',
        'gaji_pokok',
        'jumlah_gaji',
        'periode',
    ];

    public function getJumlahGajiFormattedAttribute()
    {
        return 'Rp ' . number_format($this->jumlah_gaji, 0, ',', '.');
    }
}

