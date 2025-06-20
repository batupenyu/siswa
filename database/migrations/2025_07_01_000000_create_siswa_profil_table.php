<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('siswa_profil', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->string('nama_panggilan')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->string('tempat_tanggal_lahir')->nullable();
            $table->enum('agama', ['islam', 'budha', 'hindu', 'kristen'])->nullable();
            $table->string('kewarganegaraan')->nullable();
            $table->integer('anak_ke_berapa')->nullable();
            $table->integer('jumlah_saudara_kandung')->nullable();
            $table->integer('jumlah_saudara_tiri')->nullable();
            $table->integer('jumlah_saudara_angkat')->nullable();
            $table->enum('status_anak', ['yatim', 'piatu', 'yatim-piatu', '-'])->nullable();
            $table->string('bahasa_sehari_hari_di_rumah')->nullable();
            $table->text('alamat')->nullable();
            $table->string('nomor_telepon')->nullable();
            $table->enum('tinggal_dengan', ['orang_tua', 'saudara', 'di_asrama', 'kos'])->nullable();
            $table->float('jarak_tempat_tinggal_ke_sekolah')->nullable();
            $table->string('golongan_darah')->nullable();
            $table->enum('penyakit_yang_pernah_diderita', ['tbc', 'cacar', 'malaria', 'dll', '-'])->nullable();
            $table->string('kelainan_jasmani')->nullable();
            $table->string('tinggi_dan_berat_badan')->nullable();
            $table->string('pendidikan_sebelumnya')->nullable();
            $table->string('lulusan_dari')->nullable();
            $table->string('tanggal_dan_nomor_sttb')->nullable();
            $table->string('lama_belajar')->nullable();
            $table->string('dari_sekolah')->nullable();
            $table->text('alasan_pindah')->nullable();
            $table->string('diterima_di_sekolah_ini')->nullable();
            $table->string('di_kelas')->nullable();
            $table->string('kelompok')->nullable();
            $table->string('kompetensi_keahlian')->nullable();
            $table->date('tanggal_diterima')->nullable();
            $table->string('kesenian_kegemaran_siswa')->nullable();
            $table->string('olahraga_kegemaran_siswa')->nullable();
            $table->string('kegiatan_kemasyarakatan_kegemaran_siswa')->nullable();
            $table->string('kegemaran_lain_lain')->nullable();
            $table->timestamps();

            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa_profil');
    }
};
