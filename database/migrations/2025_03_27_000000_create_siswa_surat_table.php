<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaSuratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa_surat', function (Blueprint $table) {
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('surat_id');

            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
            $table->foreign('surat_id')->references('id')->on('surat')->onDelete('cascade');

            $table->primary(['siswa_id', 'surat_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswa_surat');
    }
}
