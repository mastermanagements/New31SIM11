<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelasiAModelBisnis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('a_model_bisnis', function (Blueprint $table) {
            $table->foreign('id_jenis_mb')->references('id')->on('a_jenis_mb');
            $table->foreign('id_sub_mb')->references('id')->on('a_sub_mb');
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
        Schema::table('a_model_bisnis', function (Blueprint $table) {
            //
        });
    }
}
