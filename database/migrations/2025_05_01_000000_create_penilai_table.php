<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilai', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jabatan');
            $table->string('nip')->unique();
            $table->string('pangkat');
            $table->string('unitkerja');
            $table->string('instansi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penilai');
    }
}
