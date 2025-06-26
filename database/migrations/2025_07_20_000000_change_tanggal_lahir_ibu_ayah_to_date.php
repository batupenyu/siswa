<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTanggalLahirIbuAyahToDate extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('siswa_profil', function (Blueprint $table) {
            $table->date('tanggal_lahir_ibu')->nullable()->change();
            $table->date('tanggal_lahir_ayah')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswa_profil', function (Blueprint $table) {
            $table->string('tanggal_lahir_ibu')->nullable()->change();
            $table->string('tanggal_lahir_ayah')->nullable()->change();
        });
    }
}
