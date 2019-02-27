<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUIjinUsaha extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('u_ijin_usaha', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nm_ijin');
            $table->string('no_ijin');
            $table->date('berlaku');
            $table->string('kualifikasi');
            $table->string('instansi_pemberi');
            $table->text('klasifikasi');
            $table->string('file_iu');
            $table->string('no_rak')->nullable();
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
        Schema::dropIfExists('u_ijin_usaha');
    }
}
