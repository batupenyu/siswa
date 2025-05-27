<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotoSuratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photo_surat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('st_surat_id');
            $table->string('photo');
            $table->timestamps();

            $table->foreign('st_surat_id')->references('id')->on('st_pegawai')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photo_surat');
    }
}
