<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('st_pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('dasar_surat');
            $table->date('tgl_awal');
            $table->date('tgl_akhir');
            $table->string('nama_kegiatan');
            $table->date('tgl_kegiatan');
            $table->time('jam_kegiatan');
            $table->date('tgl_ditetapkan');
            $table->string('tempat_ditetapkan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('st_pegawai');
    }
};
