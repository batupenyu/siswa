<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('surat_panggilan', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_surat');
            $table->string('nomor_surat');
            $table->string('sifat')->nullable();
            $table->string('lampiran')->nullable();
            $table->string('perihal');
            $table->string('nama_siswa');
            $table->date('hari_tanggal');
            $table->string('tempat');
            $table->text('agenda');
            $table->text('paragraf_penutup')->nullable();
            // Tanda tangan guru BK
            $table->string('nama_guru_bk');
            $table->string('pangkat_golongan')->nullable();
            $table->string('nip')->nullable();
            $table->boolean('an_guru_bk')->default(false); // true = a.n. guru BK
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_panggilan');
    }
};
