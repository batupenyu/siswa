<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRincianTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rincians', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('st_pegawai_id')->nullable();
            $table->decimal('biaya_transportasi', 15, 2)->nullable();
            $table->decimal('biaya_penginapan', 15, 2)->nullable();
            $table->decimal('biaya_tiket', 15, 2)->nullable();
            $table->decimal('transport_lokal', 15, 2)->nullable();
            $table->decimal('uang_makan', 15, 2)->nullable();
            $table->decimal('uang_saku', 15, 2)->nullable();
            $table->decimal('uang_representasi', 15, 2)->nullable();
            $table->decimal('uang_kediklatan', 15, 2)->nullable();
            $table->string('korek')->nullable();
            $table->timestamps();

            // $table->foreign('st_pegawai_id')->references('id')->on('st_pegawai')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rincians');
    }
}
