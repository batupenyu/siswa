<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaDispensasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa_dispensasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dispensasi_id');
            $table->unsignedBigInteger('siswa_id');
            $table->timestamps();

            $table->foreign('dispensasi_id')->references('id')->on('dispensasi')->onDelete('cascade');
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');

            $table->unique(['dispensasi_id', 'siswa_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswa_dispensasi');
    }
}
