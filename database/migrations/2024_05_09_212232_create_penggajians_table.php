<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenggajiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penggajian', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pegawai');
            $table->integer('jumlah_hari_kerja');
            $table->integer('jumlah_hari_hadir'); // Tambahkan kolom ini
            $table->integer('gaji_pokok');
            $table->integer('jumlah_gaji');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penggajian');
    }
}
