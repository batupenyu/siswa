<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGambarSuratTable extends Migration
{
    public function up()
    {
        Schema::create('gambar_surat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('surat_id'); // Relasi ke surat
            $table->string('gambar'); // Nama file gambar
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('surat_id')->references('id')->on('surat')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('gambar_surat');
    }
}
