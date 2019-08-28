<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSatuanKpi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h_satuan_kpi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('satuan_kpi');
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
        Schema::dropIfExists('h_satuan_kpi');
    }
}