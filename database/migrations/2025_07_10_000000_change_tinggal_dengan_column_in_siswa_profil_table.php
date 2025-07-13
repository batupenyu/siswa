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
        Schema::table('siswa_profil', function (Blueprint $table) {
            $table->string('tinggal_dengan')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswa_profil', function (Blueprint $table) {
            $table->enum('tinggal_dengan', ['orang tua', 'menumpang', 'di asrama', 'kost'])->nullable()->change();
        });
    }
};
