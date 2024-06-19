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
        Schema::create('peralatan', function (Blueprint $table) {
            $table->id();
            $table->string('id_peralatan', 10)->unique();
            $table->string('nama_peralatan', 50);
            $table->string('status')->default('Tidak Dipakai');
            $table->string('id_pesanan')->default('-');
            $table->timestamps();
        });

        // Insert some data
        DB::table('peralatan')->insert(
            [
                [
                    'id_peralatan' => 'PRT-001',
                    'nama_peralatan' => 'Mesin Cuci 1',
                ],
                [
                    'id_peralatan' => 'PRT-002',
                    'nama_peralatan' => 'Mesin Cuci 2',
                ],
                [
                    'id_peralatan' => 'PRT-003',
                    'nama_peralatan' => 'Setrika 1',
                ],
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peralatan');
    }
};
