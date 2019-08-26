<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGSkorPosisiCf extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('g_skor_posisi_cf', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_sub_cf')->unsigned();
            $table->integer('skor_sub_cf');
            $table->integer('id_jabatan')->unsigned();
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
        Schema::dropIfExists('g_skor_posisi_cf');
    }
}
