<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationKSubsubAkun extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('k_subsub_akun', function (Blueprint $table) {
            $table->foreign('id_sub_akun')->references('id')->on('k_sub_akun');
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
        Schema::table('k_subsub_akun', function (Blueprint $table) {
		 });
    }
}
