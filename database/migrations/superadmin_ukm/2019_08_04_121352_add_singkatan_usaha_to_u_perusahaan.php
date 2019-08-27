<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSingkatanUsahaToUPerusahaan extends Migration
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
			$table->string('singkatan_usaha',50)->after('nm_usaha');
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
			$table->dropColumn('singkatan_usaha');
        });
    }
}
