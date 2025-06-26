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
            // $table->unsignedBigInteger('siswa_id');
            $table->string('nama_lengkap')->nullable();
            $table->string('nama_panggilan')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->enum('agama', ['islam', 'budha', 'hindu', 'kristen'])->nullable();
            $table->string('kewarganegaraan')->nullable();
            $table->integer('anak_ke_berapa')->nullable();
            $table->integer('jumlah_saudara_kandung')->nullable();
            $table->integer('jumlah_saudara_tiri')->nullable();
            $table->integer('jumlah_saudara_angkat')->nullable();
            $table->string('bahasa_sehari_hari_di_rumah')->nullable();
            $table->text('alamat')->nullable();
            $table->string('nomor_telepon')->nullable();
            $table->enum('tinggal_dengan', ['orang tua', 'menumpang', 'di asrama', 'kost'])->nullable();
            $table->float('jarak_tempat_tinggal_ke_sekolah')->nullable();
            $table->float('alat_transportasi_ke_sekolah')->nullable();
            $table->string('berat_badan')->nullable();
            $table->string('tinggi_badan')->nullable();
            $table->string('golongan_darah')->nullable();
            $table->enum('penyakit_yang_pernah_diderita', ['tbc', 'cacar', 'malaria', 'dll', '-'])->nullable();
            $table->string('asal_SD')->nullable();
            $table->string('tanggal_sttb_SD')->nullable();
            $table->string('nomor_sttb_SD')->nullable();
            $table->string('lama_belajar_SD')->nullable();
            $table->string('asal_SMP')->nullable();
            $table->string('tanggal_sttb_SMP')->nullable();
            $table->string('nomor_sttb_SMP')->nullable();
            $table->string('lama_belajar_SMP')->nullable();

            // Ayah fields
            $table->string('nama_ayah')->nullable();
            $table->string('tempat_lahir_ayah')->nullable();
            $table->string('tanggal_lahir_ayah')->nullable();
            $table->string('alamat_ayah')->nullable();
            $table->string('nomor_telepon_ayah')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('penghasilan_perbulan_ayah')->nullable();
            $table->string('pendidikan_ayah')->nullable();
            $table->string('kewarganegaraan_ayah')->nullable();

            // Ibu fields
            $table->string('nama_ibu')->nullable();
            $table->string('tempat_lahir_ibu')->nullable();
            $table->string('tanggal_lahir_ibu')->nullable();
            $table->string('alamat_ibu')->nullable();
            $table->string('nomor_telepon_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('penghasilan_perbulan_ibu')->nullable();
            $table->string('pendidikan_ibu')->nullable();
            $table->string('kewarganegaraan_ibu')->nullable();


            // Wali fields
            $table->string('nama_wali')->nullable();
            $table->string('alamat_wali')->nullable();
            $table->string('nomor_telepon_wali')->nullable();


            // add field 'kegemaran_',
            $table->string('kegemaran_olah_raga')->nullable();
            $table->string('kegemaran_kemasyarakatan')->nullable();
            $table->string('kegemaran_hasta_karya')->nullable();

            $table->enum('jurusan', ['TBSM', 'TKR', 'TITL', 'TP', 'TKJ'])->nullable();
            $table->timestamps();


            // $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
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
