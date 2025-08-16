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
        Schema::table('st_pegawai', function (Blueprint $table) {
            //
            $table->string('tempat_kegiatan')->after('jam_kegiatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('st_pegawai', function (Blueprint $table) {
            $table->dropColumn('tempat_kegiatan');
            //
        });
    }
};
