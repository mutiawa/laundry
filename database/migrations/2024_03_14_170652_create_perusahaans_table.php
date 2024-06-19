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
        Schema::create('perusahaan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_perusahaan', 10);
            $table->string('nama_perusahaan', 50);
            $table->string('alamat_perusahaan', 100);
            $table->timestamps();
        });

        // Insert some data
        DB::table('perusahaan')->insert([
            'kode_perusahaan' => 'PR-001',
            'nama_perusahaan' => 'Laundry',
            'alamat_perusahaan' => 'Jl. Raya Yang Tak Kunjung Sepi',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perusahaan');
    }
};
