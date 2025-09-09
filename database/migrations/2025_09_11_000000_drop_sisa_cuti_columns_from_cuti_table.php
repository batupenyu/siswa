<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropSisaCutiColumnsFromCutiTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cuti', function (Blueprint $table) {
            $table->dropColumn(['sisa_cuti_n', 'sisa_cuti_n_1', 'sisa_cuti_n_2']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cuti', function (Blueprint $table) {
            $table->integer('sisa_cuti_n')->nullable();
            $table->integer('sisa_cuti_n_1')->nullable();
            $table->integer('sisa_cuti_n_2')->nullable();
        });
    }
}
