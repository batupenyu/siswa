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
        Schema::table('photos', function (Blueprint $table) {
            $table->dropColumn('path'); // Remove the path column
            $table->unsignedBigInteger('surat_id')->nullable(); // Add surat_id column
            $table->string('photos')->nullable(); // Add photos column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('photos', function (Blueprint $table) {
            $table->string('path'); // Re-add the path column
            $table->dropColumn('surat_id'); // Remove surat_id column
            $table->dropColumn('photos'); // Remove photos column
        });
    }
};
