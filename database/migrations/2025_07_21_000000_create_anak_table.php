<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnakTable extends Migration
{
    public function up()
    {
        Schema::create('anak_table', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pegawais_id');
            $table->string('nama');
            $table->date('tgl_lahir');
            $table->string('tempat_lahir');
            $table->enum('status_pekerjaan', ['bekerja', 'belum bekerja']);
            $table->enum('status_pernikahan', ['menikah', 'belum menikah']);
            $table->enum('status_tanggungan', ['ya', 'tidak']);
            $table->string('pendidikan');
            $table->string('nama_sekolah');
            $table->timestamps();

            $table->foreign('pegawais_id')->references('id')->on('pegawais')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('anak_table');
    }
}
