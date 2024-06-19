<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jurnal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('transaksi_id');
            $table->integer('id_perusahaan');
            $table->string('kode_akun');
            $table->datetime('tgl_jurnal');
            $table->string('posisi_d_c');
            $table->integer('nominal');
            $table->string('kelompok');
            $table->string('transaksi');
            $table->timestamps();
        });

        // Insert some data
        DB::table('jurnal')->insert(
            [
                [
                    'transaksi_id' => 1,
                    'id_perusahaan' => 1,
                    'kode_akun' => '111',
                    'tgl_jurnal' => '2024-05-17 00:00:00',
                    'posisi_d_c' => 'd',
                    'nominal' => 1000000,
                    'kelompok' => '1',
                    'transaksi' => 'penjualan',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'transaksi_id' => 2,
                    'id_perusahaan' => 1,
                    'kode_akun' => '411',
                    'tgl_jurnal' => '2024-05-17 00:00:00',
                    'posisi_d_c' => 'c',
                    'nominal' => 1000000,
                    'kelompok' => '1',
                    'transaksi' => 'penjualan',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurnal');
    }
};
