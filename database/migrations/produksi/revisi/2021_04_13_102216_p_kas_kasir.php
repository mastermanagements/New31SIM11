<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PKasKasir extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_kas_kasir', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_shift_kasir')->unsigned();
            $table->integer('id_akun_aktif')->unsigned();
            $table->integer('id_perusahaan')->unsigned();
            $table->integer('id_karyawan')->default(0);
            $table->foreign('id_perusahaan')->references('id')->on('u_perusahaan')->onDelete('cascade');
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
        Schema::dropIfExists('p_kas_kasir');
    }
}
