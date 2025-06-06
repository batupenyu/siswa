<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDispensasiTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dispensasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kegiatan');
            $table->date('tgl_kegiatan');
            $table->string('waktu_kegiatan');
            $table->date('tgl_ditetapkan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispensasi');
    }
}
