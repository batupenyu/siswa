<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTglTempatDitetapkanToIppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ipps', function (Blueprint $table) {
            $table->date('tgl_ditetapkan')->nullable()->after('nominal');
            $table->string('tempat_ditetapkan')->nullable()->after('tgl_ditetapkan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ipps', function (Blueprint $table) {
            $table->dropColumn(['tgl_ditetapkan', 'tempat_ditetapkan']);
        });
    }
}
