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
            $table->decimal('biaya_transportasi', 15, 2)->nullable();
            $table->decimal('biaya_penginapan', 15, 2)->nullable();
            $table->decimal('biaya_tiket', 15, 2)->nullable();
            $table->decimal('transport_lokal', 15, 2)->nullable();
            $table->decimal('uang_makan', 15, 2)->nullable();
            $table->decimal('uang_saku', 15, 2)->nullable();
            $table->decimal('uang_representasi', 15, 2)->nullable();
            $table->decimal('uang_kediklatan', 15, 2)->nullable();
            $table->string('korek')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('st_pegawai', function (Blueprint $table) {
            $table->dropColumn([
                'biaya_transportasi',
                'biaya_penginapan',
                'biaya_tiket',
                'transport_lokal',
                'uang_makan',
                'uang_saku',
                'uang_representasi',
                'uang_kediklatan',
                'korek',
            ]);
        });
    }
};
