<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGBonus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('g_lembur', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_ky')->unsigned();
            $table->integer('id_slip')->unsigned();
            $table->integer('jum_lembur');
            $table->integer('jum_besaran_lembur');
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
        Schema::dropIfExists('g_bonus');
    }
}
