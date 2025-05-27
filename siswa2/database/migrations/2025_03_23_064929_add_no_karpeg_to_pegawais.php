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
        Schema::table('pegawais', function (Blueprint $table) {
            // Add the new columns to the 'pegawais' table
            $table->string('no_karpeg')->nullable(); // Nomor Karpeg (nullable for flexibility)
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable(); // Jenis Kelamin: L (Laki-laki), P (Perempuan)
            $table->date('tgl_lahir')->nullable(); // Tanggal Lahir
            $table->string('tempat_lahir')->nullable(); // Tempat Lahir
            $table->date('tgl_tmt_jabatan')->nullable(); // TMT Jabatan (Tanggal Mulai Tugas Jabatan)
            $table->date('tgl_tmt_pangkat')->nullable(); // TMT Pangkat (Tanggal Mulai Tugas Pangkat)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pegawais', function (Blueprint $table) {
            // Drop the added columns if the migration is rolled back
            $table->dropColumn('no_karpeg');
            $table->dropColumn('jenis_kelamin');
            $table->dropColumn('tgl_lahir');
            $table->dropColumn('tempat_lahir');
            $table->dropColumn('tgl_tmt_jabatan');
            $table->dropColumn('tgl_tmt_pangkat');
        });
    }
};