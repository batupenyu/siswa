<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('surat_panggilan', function (Blueprint $table) {
            $table->unsignedBigInteger('kop_id')->nullable()->after('an_guru_bk');
        });
    }

    public function down(): void
    {
        Schema::table('surat_panggilan', function (Blueprint $table) {
            $table->dropColumn('kop_id');
        });
    }
};
