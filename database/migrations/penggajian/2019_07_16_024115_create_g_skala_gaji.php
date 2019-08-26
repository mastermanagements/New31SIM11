<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGSkalaGaji extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('g_skala_gaji', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_jabatan')->unsigned();
            $table->integer('id_klasifikasi')->unsigned();
            $table->integer('besaran_gaji');
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
        Schema::dropIfExists('g_skala_gaji');
    }
}
