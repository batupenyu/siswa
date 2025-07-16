<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAgamaAlamatTglTmtCpnsToPegawaisTable extends Migration
{
    public function up()
    {
        Schema::table('pegawais', function (Blueprint $table) {
            $table->enum('agama', ['islam', 'kristen', 'protestan', 'hindu', 'budha', 'konghucu'])->nullable()->after('pangkat');
            $table->text('alamat')->nullable()->after('agama');
            $table->date('tgl_tmt_cpns')->nullable()->after('alamat');
        });
    }

    public function down()
    {
        Schema::table('pegawais', function (Blueprint $table) {
            $table->dropColumn(['agama', 'alamat', 'tgl_tmt_cpns']);
        });
    }
}
