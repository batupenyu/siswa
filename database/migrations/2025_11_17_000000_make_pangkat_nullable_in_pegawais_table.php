<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakePangkatNullableInPegawaisTable extends Migration
{
    public function up()
    {
        Schema::table('pegawais', function (Blueprint $table) {
            $table->string('pangkat')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('pegawais', function (Blueprint $table) {
            $table->string('pangkat')->nullable(false)->change();
        });
    }
}
