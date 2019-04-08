<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationASpk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('a_spk', function (Blueprint $table) {
            $table->foreign('id_klien')->references('id')->on('a_klien');
            $table->foreign('id_prov')->references('id')->on('u_provinsi');
            $table->foreign('id_kab')->references('id')->on('u_kabupaten');
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
        Schema::table('a_spk', function (Blueprint $table) {
            //
        });
    }
}
