<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToSuratIzinPegawaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('surat_izin_pegawai', function (Blueprint $table) {
            $table->enum('status', ['keterlambatan', 'meninggalkan'])->after('jam')->default('keterlambatan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('surat_izin_pegawai', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
