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
        Schema::create('sukets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswas_id');
            $table->longText('description');
            $table->date('tgl_ditetapkan');
            $table->string('tempat_ditetapkan');
            $table->timestamps();

            $table->foreign('siswas_id')->references('id')->on('siswas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sukets');
    }
};
