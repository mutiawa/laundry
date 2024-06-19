<?php
// app/Models/Presensi.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $table = 'presensi';

    protected $fillable = ['kode_presensi', 'kode_pegawai','nama_pegawai' ,'check_in', 'image'];

    public static function getPresensiId()
    {
        $latestPresensi = static::orderBy('kode_presensi', 'desc')->first();

        if (!$latestPresensi) {
            return 'PR-001';
        }

        $numericPart = (int) substr($latestPresensi->kode_presensi, 3);
        $nextNumericPart = $numericPart + 1;

        return 'PR-' . str_pad($nextNumericPart, 3, '0', STR_PAD_LEFT);
    }

    public function pegawai()
    {
        return $this->belongsTo(PegawaiModel::class, 'kode_pegawai', 'kode');
    }
}
