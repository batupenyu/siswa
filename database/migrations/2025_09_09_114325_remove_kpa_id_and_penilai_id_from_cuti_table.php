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
        Schema::table('cuti', function (Blueprint $table) {
            $table->dropForeign(['penilai_id']);
            $table->dropForeign(['kpa_id']);
            $table->dropColumn(['penilai_id', 'kpa_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cuti', function (Blueprint $table) {
            $table->unsignedBigInteger('penilai_id');
            $table->unsignedBigInteger('kpa_id');
            $table->foreign('penilai_id')->references('id')->on('penilai')->onDelete('cascade');
            $table->foreign('kpa_id')->references('id')->on('kpa')->onDelete('cascade');
        });
    }
};