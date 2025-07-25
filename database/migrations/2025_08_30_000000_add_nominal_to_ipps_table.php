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
        Schema::table('ipps', function (Blueprint $table) {
            $table->decimal('nominal', 15, 2)->default(0)->after('bulan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ipps', function (Blueprint $table) {
            $table->dropColumn('nominal');
        });
    }
};
