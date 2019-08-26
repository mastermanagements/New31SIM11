<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIDividenPelaksana extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_dividen_pelaksana', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_pelaksana')->unsigned();
            $table->integer('id_bulan_dividen')->unsigned();
            $table->bigInteger('besar_dividen');
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
        Schema::dropIfExists('i_dividen_pelaksana');
    }
}
