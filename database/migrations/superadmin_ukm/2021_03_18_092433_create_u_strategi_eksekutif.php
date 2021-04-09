<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUStrategiEksekutif extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('u_strategi_eksekutif', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('id_teks')->unsigned();
          $table->string('nama');
          $table->text('isi');
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
        Schema::dropIfExists('u_strategi_eksekutif');
    }
}