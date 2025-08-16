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
        Schema::create('pegawai_st_pegawai', function (Blueprint $table) {
            $table->unsignedBigInteger('pegawai_id');
            $table->unsignedBigInteger('st_pegawai_id');
            $table->primary(['pegawai_id', 'st_pegawai_id']);
            $table->foreign('pegawai_id')->references('id')->on('pegawais')->onDelete('cascade');
            $table->foreign('st_pegawai_id')->references('id')->on('st_pegawai')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai_st_pegawai');
    }
};
