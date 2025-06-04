<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratIzinPegawaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_izin_pegawai', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pegawais_id');
            $table->date('tanggal');
            $table->time('jam');
            $table->enum('status', ['keterlambatan', 'meninggalkan']);
            $table->enum('keperluan', ['Dinas', 'Pribadi']);
            $table->string('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('pegawais_id')->references('id')->on('pegawais')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surat_izin_pegawai');
    }
}
