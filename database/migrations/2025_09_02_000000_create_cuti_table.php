<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCutiTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cuti', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pegawais_id');
            $table->unsignedBigInteger('penilai_id');
            $table->unsignedBigInteger('kpa_id');
            $table->enum('jenis_cuti', [
                'tahunan',
                'besar',
                'sakit',
                'melahirkan',
                'alasan_penting',
                'luar_tanggungan'
            ]);
            $table->enum('status_penilai', ['disetujui', 'perubahan', 'ditangguhkan', 'tidak_disetujui'])->nullable();
            $table->enum('status_kpa', ['disetujui', 'perubahan', 'ditangguhkan', 'tidak_disetujui'])->nullable();
            $table->text('alasan');
            $table->integer('lama_cuti');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('telepon');
            $table->text('alamat_selama_cuti');
            $table->timestamps();

            $table->foreign('pegawais_id')->references('id')->on('pegawais')->onDelete('cascade');
            $table->foreign('penilai_id')->references('id')->on('penilai')->onDelete('cascade');
            $table->foreign('kpa_id')->references('id')->on('kpa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuti');
    }
}
