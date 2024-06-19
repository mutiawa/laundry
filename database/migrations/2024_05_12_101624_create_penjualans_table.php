<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penjualan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_transaksi');
            $table->integer('id_pelanggan');
            $table->datetime('tgl_transaksi', precision: 0);
            $table->datetime('tgl_expired');
            $table->integer('total_harga');
            $table->string('status');
            // $table->timestamps();
        });

        // Insert into penjualan
        DB::table('penjualan')->insert([
            'no_transaksi' => 'FK-0001',
            'id_pelanggan' => 1,
            'tgl_transaksi' => now(),
            'tgl_expired' => now()->addDays(7),
            'total_harga' => 100000,
            'status' => 'selesai',
        ]);


        Schema::create('penjualan_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_transaksi');
            $table->integer('id_layanan');
            $table->integer('harga_layanan');
            $table->integer('jml_kg');
            $table->integer('total');
            $table->datetime('tgl_transaksi');
            $table->datetime('tgl_expired');
            // $table->timestamps();
        });

        // Insert into penjualan_detail
        DB::table('penjualan_detail')->insert([
            [
                'no_transaksi' => 'FK-0001',
                'id_layanan' => 1,
                'harga_layanan' => 15000,
                'jml_kg' => 3,
                'total' => 45000,
                'tgl_transaksi' => now(),
                'tgl_expired' => now()->addDays(7),
            ],
            [
                'no_transaksi' => 'FK-0001',
                'id_layanan' => 2,
                'harga_layanan' => 35000,
                'jml_kg' => 1,
                'total' => 35000,
                'tgl_transaksi' => now(),
                'tgl_expired' => now()->addDays(7)
            ]
    ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan');
    }
};
