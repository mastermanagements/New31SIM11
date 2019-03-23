<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationStrukturPerusahaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('struktur_perusahaan', function (Blueprint $table) {
            $table->foreign('id_karyawan')->references('id')->on('h_karyawan');
            $table->foreign('id_jabatan')->references('id')->on('u_jabatan_p');
            $table->foreign('id_perusahaan')->references('id')->on('u_perusahaan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('struktur_perusahaan', function (Blueprint $table) {
            //
        });
    }
}
