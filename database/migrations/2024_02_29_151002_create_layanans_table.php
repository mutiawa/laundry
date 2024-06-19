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
        Schema::create('layanan', function (Blueprint $table) {
            $table->id();
            $table->string('id_layanan');
            $table->string('nama_layanan');
            $table->string('jenis_layanan');
            $table->integer('harga');
            $table->string('deskripsi');
            $table->timestamps();
        });

        // Insert into penjualan_detail
        DB::table('layanan')->insert([
            [
                'id_layanan' => 'LYN-001',
                'nama_layanan' => 'Cuci Kering Reguler',
                'jenis_layanan' => 'Reguler',
                'harga' => 6000,
                'deskripsi' => 'Cuci kering adalah layanan pencucian tanpa menggunakan air sama sekali. Pencucian reguler dapat mencuci pakaian biasa dan pakaian dengan kain khusus.'
            ],
            [
                'id_layanan' => 'LYN-002',
                'nama_layanan' => 'Cuci Kering Express',
                'jenis_layanan' => 'Express',
                'harga' => 10000,
                'deskripsi' => 'Cuci kering adalah layanan pencucian tanpa menggunakan air sama sekali. Pencucian express lebih cepat selesai dapat mencuci pakaian biasa dan pakaian dengan kain khusus.'
            ],
            [
                'id_layanan' => 'LYN-003',
                'nama_layanan' => 'Cuci Basah Reguler',
                'jenis_layanan' => 'Reguler',
                'harga' => 4000,
                'deskripsi' => 'Cuci basah metode cuci biasa dengan layanan reguler dapat mencuci pakaian, kemeja, celana dan rok.'
            ],
            [
                'id_layanan' => 'LYN-004',
                'nama_layanan' => 'Cuci Basah Express',
                'jenis_layanan' => 'Express',
                'harga' => 8000,
                'deskripsi' => 'Cuci basah metode cuci biasa dengan layanan express lebih cepat selesai dapat mencuci pakaian, kemeja, celana dan rok.'
            ],
            [
                'id_layanan' => 'LYN-005',
                'nama_layanan' => 'Setrika Reguler',
                'jenis_layanan' => 'Reguler',
                'harga' => 2000,
                'deskripsi' => 'Setrika pakaian, kemeja, celana dan rok dengan layanan reguler.'
            ],
            [
                'id_layanan' => 'LYN-006',
                'nama_layanan' => 'Setrika Express',
                'jenis_layanan' => 'Express',
                'harga' => 5000,
                'deskripsi' => 'Setrika pakaian, kemeja, celana dan rok dengan layanan express lebih cepat selesai.'
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan');
    }
};
