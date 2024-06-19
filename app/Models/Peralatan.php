<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Peralatan extends Model
{
    use HasFactory;
    protected $table = 'peralatan';
    // list kolom yang bisa diisi
    protected $fillable = ['id_peralatan', 'nama_peralatan'];

    // query nilai max dari kode perusahaan untuk generate otomatis kode perusahaan
    static public function getIdPeralatan()
    {
        // query kode perusahaan
        $sql = "SELECT IFNULL(MAX(id_peralatan), 'PRT-000') as id_peralatan 
                FROM peralatan";
        $id_peralatan = DB::select($sql);

        // cacah hasilnya
        foreach ($id_peralatan as $idplt) {
            $ly = $idplt->id_peralatan;
        }
        // Mengambil substring tiga digit akhir dari string PR-000
        $noawal = substr($ly,-3);
        $noakhir = $noawal+1; //menambahkan 1, hasilnya adalah integer cth 1
        
        //menyambung dengan string PR-001
        $noakhir = 'PRT-'.str_pad($noakhir,3,"0",STR_PAD_LEFT); 

        return $noakhir;

    }
}
