<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWebToUPerusahaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('u_perusahaan', function (Blueprint $table) {
            //tambah field web
			$table->string('web',50)->after('jenis_usaha');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('u_perusahaan', function (Blueprint $table) {
            //rollback
			$table->dropColumn('web');
        });
    }
}
