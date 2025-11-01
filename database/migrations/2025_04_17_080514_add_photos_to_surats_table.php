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
        Schema::table('surat', function (Blueprint $table) {
<<<<<<< HEAD
            $table->json('photos')->nullable(); // Remove default value as MySQL doesn't support it for JSON
=======
            // $table->json('photos')->nullable(); // Menyimpan array path foto
            $table->json('photos')->nullable(false)->default('[]'); // Default value: array kosong

>>>>>>> 0da78d7 (commit)
        });
    }

    public function down()
    {
        Schema::table('surat', function (Blueprint $table) {
            $table->dropColumn('photos');
        });
    }
};
