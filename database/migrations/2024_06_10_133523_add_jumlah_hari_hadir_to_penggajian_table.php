<?php
// database/migrations/xxxx_xx_xx_xxxxxx_add_jumlah_hari_hadir_to_penggajian_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJumlahHariHadirToPenggajianTable extends Migration
{
    public function up()
    {
        Schema::table('penggajian', function (Blueprint $table) {
            $table->integer('jumlah_hari_hadir')->default(0);
        });
    }

    public function down()
    {
        Schema::table('penggajian', function (Blueprint $table) {
            $table->dropColumn('jumlah_hari_hadir');
        });
    }
}
