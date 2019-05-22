<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelasiStrategiBulanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('u_strategi_bulanan', function (Blueprint $table) {
            $table->foreign('id_stahunan')->references('id')->on('u_strategi_tahunan');
			$table->foreign('id_target_bulanan')->references('id')->on('u_target_bulanan');
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
        Schema::table('u_strategi_bulanan', function (Blueprint $table){
    });
	}
	
}
