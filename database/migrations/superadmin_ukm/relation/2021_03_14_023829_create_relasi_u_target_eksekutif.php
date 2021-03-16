<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelasiUTargetEksekutif extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('u_target_eksekutif', function (Blueprint $table) {
            $table->foreign('id_bagian_p')->references('id')->on('u_bagian_p');
            $table->foreign('id_jabatan_p')->references('id')->on('u_jabatan_p');
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
        Schema::table('u_target_eksekutif', function (Blueprint $table) {
          //$table->dropForeign(['id_target_eks']);
        });
    }
}
