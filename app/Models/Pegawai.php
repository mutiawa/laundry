<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pegawai extends Model
{
    use HasFactory;
    protected $table = 'pegawai';

    protected $fillable = ['kode_pegawai', 'kode_pegawai', 'nama_pegawai', 'no_telp_pegawai', 'jenis_kelamin_pegawai', 'alamat'];

    public static function getIdPegawai()
    {
        // Query kode pegawai
        $sql = "SELECT IFNULL(MAX(kode_pegawai), 'PG-000') as kode_pegawai 
                FROM pegawai";
        $kodepegawai = DB::select($sql);

        // Cacah hasilnya
        foreach ($kodepegawai as $kdPrsh) {
            $kd = $kdPrsh->kode_pegawai;
        }

        // Mengambil substring tiga digit akhir dari string PR-000
        $noAwal = substr($kd, -3);
        $noAkhir = $noAwal + 1; // Menambahkan 1, hasilnya adalah integer contoh 1

        // Menyambung dengan string PG-001
        $noAkhir = 'PG-' . str_pad($noAkhir, 3, "0", STR_PAD_LEFT);

        return $noAkhir;
    }

}
