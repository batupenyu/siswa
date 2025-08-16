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
            $table->text('maksud_tujuan')->nullable()->after('tempat_ditetapkan');
            $table->text('materi_narsum')->nullable()->after('maksud_tujuan');
            $table->text('hasil')->nullable()->after('materi_narsum');
            $table->text('kesimpulan')->nullable()->after('hasil');
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
