<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';
    // protected $primaryKey = 'id_pelanggan';
    protected $guarded = ['id'];
    // query nilai max dari kode perusahaan untuk generate otomatis kode perusahaan
    public static function getPelangganId()
    {
        // query kode perusahaan
        $sql = "SELECT IFNULL(MAX(id_pelanggan), 'CST-000') as id_pelanggan 
                FROM pelanggan";
        $pelangganid = DB::select($sql);

        // cacah hasilnya
        foreach ($pelangganid as $idcst) {
            $kd = $idcst->id_pelanggan;
        }
        // Mengambil substring tiga digit akhir dari string PR-000
        $noawal = substr($kd,-3);
        $noakhir = $noawal+1; //menambahkan 1, hasilnya adalah integer cth 1
        
        //menyambung dengan string PR-001
        $noakhir = 'CST-'.str_pad($noakhir,3,"0",STR_PAD_LEFT); 

        return $noakhir;

    }

}