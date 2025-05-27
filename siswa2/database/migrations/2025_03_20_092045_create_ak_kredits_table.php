<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAkKreditsTable extends Migration
{
    public function up()
    {
        Schema::create('ak_kredits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pegawais_id'); // Foreign key
            $table->date('startDate');
            $table->date('endDate');
            $table->enum('predikat', [
                'Sangat Baik',
                'Baik',
                'Perlu Perbaikan',
                'Kurang',
                'Sangat Kurang',
            ]);

            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('pegawais_id')->references('id')->on('pegawais')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ak_kredits');
    }
}