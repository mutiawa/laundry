<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bahanbaku extends Model
{
    use HasFactory;

    protected $table = 'bahan_baku';

    protected $guarded = ['id'];

    // Method untuk mengambil nilai maksimum kode bahanbaku dari database
    //get untuk mengambil kode bahanbaku secara otomatis dari db 
    static public function getKodebahanbaku()
    {
        // Query untuk mengambil nilai maksimum bahanbaku_kode dari tabel bahanbaku
        $max_bahanbaku_kode = Bahanbaku::max('bahanbaku_kode');

        // Jika nilai maksimum tidak ditemukan, beri nilai awal BB-000
        if (!$max_bahanbaku_kode) {
            return 'BB-001';
        }

        // Mengambil tiga digit terakhir dari bahanbaku_kode maksimum
        $no_awal = (int) substr($max_bahanbaku_kode, -3);

        // Menambahkan 1 ke tiga digit terakhir
        $no_akhir = $no_awal + 1;

        // Menyambungkan string BB- dengan tiga digit terakhir yang sudah ditambahkan 1
        $bahanbaku_kode_baru = 'BB-' . str_pad($no_akhir, 3, "0", STR_PAD_LEFT);

        return $bahanbaku_kode_baru;
    }

    public function produkdetails() {
        return $this->hasMany(ProdukDetail::class);
    }
    
}