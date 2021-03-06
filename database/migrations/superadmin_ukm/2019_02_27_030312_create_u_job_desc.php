<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUJobDesc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('u_job_desc', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_jabatan_p')->unsigned();
            $table->integer('atasan')->unsigned();
            $table->text('ruang_lingkup');
            $table->string('hub_kedalam');
            $table->string('hub_keluar');
            $table->string('limpahan_wewenang');
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
        Schema::dropIfExists('u_job_desc');
    }
}
