<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBendsTable extends Migration
{
    public function up()
    {
        Schema::create('bends', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pegawais_id');
            $table->enum('bendahara', ['ipp', 'apbn', 'apbd']);
            $table->timestamps();

            $table->foreign('pegawais_id')->references('id')->on('pegawais')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bends');
    }
}
