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
            $columnsToDrop = [];
            if (Schema::hasColumn('cuti', 'sisa_cuti_n')) {
                $columnsToDrop[] = 'sisa_cuti_n';
            }
            if (Schema::hasColumn('cuti', 'sisa_cuti_n_1')) {
                $columnsToDrop[] = 'sisa_cuti_n_1';
            }
            if (Schema::hasColumn('cuti', 'sisa_cuti_n_2')) {
                $columnsToDrop[] = 'sisa_cuti_n_2';
            }
            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
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
