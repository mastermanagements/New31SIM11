<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationAKlien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('a_klien', function (Blueprint $table) {
			
			//$table->foreign('id_sdk')->references('id')->on('m_sumber_data_klien');
			//$table->foreign('id_penanda_sdk')->references('id')->on('m_penanda_sdk');
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
         Schema::table('a_klien', function (Blueprint $table) {
            //
        });
    }
}
