<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHKpi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h_kpi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_aku')->unsigned();
            $table->string('nm_kpi');
            $table->integer('bobot_kpi');
            $table->integer('targat_kpi');
            $table->integer('id_satuan_kpi')->unsigned();
            $table->integer('id_jenis_kpi')->unsigned();
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
        Schema::dropIfExists('h_kpi');
    }
}
