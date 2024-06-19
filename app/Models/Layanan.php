<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Layanan extends Model
{
    use HasFactory;
    protected $table = 'layanan';
    // list kolom yang bisa diisi
    protected $fillable = ['id_layanan','nama_layanan','jenis_layanan','harga','deskripsi'];

    // query nilai max dari kode perusahaan untuk generate otomatis kode perusahaan
    static public function getIdLayanan()
    {
        // query kode perusahaan
        $sql = "SELECT IFNULL(MAX(id_layanan), 'LYN-000') as id_layanan 
                FROM layanan";
        $id_layanan = DB::select($sql);

        // cacah hasilnya
        foreach ($id_layanan as $idlyn) {
            $ly = $idlyn->id_layanan;
        }
        // Mengambil substring tiga digit akhir dari string PR-000
        $noawal = substr($ly,-3);
        $noakhir = $noawal+1; //menambahkan 1, hasilnya adalah integer cth 1
        
        //menyambung dengan string PR-001
        $noakhir = 'LYN-'.str_pad($noakhir,3,"0",STR_PAD_LEFT); 

        return $noakhir;

    }
}