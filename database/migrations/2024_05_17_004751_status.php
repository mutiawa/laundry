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
        Schema::create('status_transaksi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_transaksi');
            $table->integer('id_pelanggan');
            $table->string('status');
            $table->date('waktu');
        });

        Schema::create('status_pemesanan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status');
            $table->string('deskripsi');
        });

        DB::table('status_pemesanan')->insert([
            [
                'status' => 'pesan',
                'deskripsi' => 'Pemesanan Produk',
            ],
            [
                'status' => 'siap_bayar',
                'deskripsi' => 'Checkout',
            ],
            [
                'status' => 'konfirmasi_bayar',
                'deskripsi' => 'Konfirmasi Pembayaran',
            ],
            [
                'status' => 'selesai',
                'deskripsi' => 'Pesanan Selesai',
            ],
            [
                'status' => 'expired',
                'deskripsi' => 'Pesanan Expired',
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status');
    }
};
