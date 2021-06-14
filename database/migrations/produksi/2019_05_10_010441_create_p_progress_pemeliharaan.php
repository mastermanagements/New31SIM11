<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePProgressPemeliharaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_progres_pemeliharaan', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tgl_dikerjakan');
            $table->integer('id_pemeliharaan')->unsigned();
            $table->text('masalah')->nullable();
            $table->text('solusi')->nullable();
            $table->text('rincian_pekerjaan');
            $table->text('ket');
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
        Schema::dropIfExists('p_progres_pemeliharaan');
    }
}
