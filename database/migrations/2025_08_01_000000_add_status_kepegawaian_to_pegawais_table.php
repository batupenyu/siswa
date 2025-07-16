<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusKepegawaianToPegawaisTable extends Migration
{
    public function up()
    {
        Schema::table('pegawais', function (Blueprint $table) {
            $table->enum('status_kepegawaian', ['PNS', 'PPPK', 'Honor', '-'])->nullable()->after('pangkat');
        });
    }

    public function down()
    {
        Schema::table('pegawais', function (Blueprint $table) {
            $table->dropColumn('status_kepegawaian');
        });
    }
}
