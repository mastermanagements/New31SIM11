<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateISahamPerdana extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_saham_perdana', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_periode_invest')->unsigned();
            $table->integer('lembar_saham_perdana');
            $table->integer('nilai_saham');
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
        Schema::dropIfExists('i_saham_perdana');
    }
}
