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
        Schema::table('st_pegawai', function (Blueprint $table) {
            $table->text('maksud_tujuan')->nullable();
            $table->text('materi_narsum')->nullable();
            $table->text('hasil')->nullable();
            $table->text('kesimpulan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('st_pegawai', function (Blueprint $table) {
            $table->dropColumn(['maksud_tujuan', 'materi_narsum', 'hasil', 'kesimpulan']);
        });
    }
};
