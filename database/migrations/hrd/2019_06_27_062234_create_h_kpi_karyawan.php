<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHKpiKaryawan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h_kpi_karyawan', function (Blueprint $table) {
            $table->increments('id');
            $table->year('year');
            $table->integer('id_ky')->unsigned();
            $table->integer('id_aku')->unsigned();
            $table->integer('id_kpi')->unsigned();
            $table->integer('realisasi_kpi');
            $table->integer('skor_kpi');
            $table->integer('skor_akhir');
            $table->integer('id_perusahaan')->unsigned();
            $table->integer('id_karyawan')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('h_kpi_karyawan');
    }
}
