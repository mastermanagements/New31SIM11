<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelasiUStrategiJp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('u_strategi_jp', function (Blueprint $table) {
			
            $table->foreign('id_tjp')->references('id')->on('u_target_jp');
            $table->foreign('id_perusahaan')->references('id')->on('u_perusahaan');
            $table->foreign('id_karyawan')->references('id')->on('h_karyawan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('u_strategi_jp', function (Blueprint $table) {
            //
        });
    }
}
