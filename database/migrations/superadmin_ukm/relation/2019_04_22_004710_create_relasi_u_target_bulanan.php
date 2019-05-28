<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelasiUTargetBulanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
     {
        Schema::table('u_target_bulanan', function (Blueprint $table) {
			$table->foreign('id_target_tahunan')->references('id')->on('u_target_tahunan');
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
        Schema::table('u_target_bulanan', function (Blueprint $table) {
            //
        });
    }
}
