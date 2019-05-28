<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationHJabatanKy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('h_jabatan_ky', function (Blueprint $table) {
            $table->foreign('id_ky')->references('id')->on('h_karyawan');
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
       Schema::table('h_jabatan_ky', function (Blueprint $table) {
        });
    }
}
