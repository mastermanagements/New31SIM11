<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHPeriodeKerja extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h_periode_kerja', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_ky')->unsigned();
            $table->date('mulai_kerja');
            $table->date('selesai_kerja');
            $table->text('alasan_selesai');
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
        Schema::dropIfExists('h_periode_kerja');
    }
}
