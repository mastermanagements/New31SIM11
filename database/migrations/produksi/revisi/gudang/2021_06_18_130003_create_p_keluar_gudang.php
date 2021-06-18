<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePKeluarGudang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_keluar_gudang', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tgl_transaksi');
            $table->unsignedInteger('nama_pengirim');
            $table->unsignedInteger('nama_penerima');
            $table->unsignedInteger('gudang_asal');
            $table->unsignedInteger('gudang_tujuan');
            $table->integer('id_perusahaan')->unsigned();
            $table->integer('id_karyawan')->unsigned();
            $table->foreign('id_perusahaan')->references('id')->on('u_perusahaan');
            $table->foreign('id_karyawan')->references('id')->on('h_karyawan');
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
        Schema::dropIfExists('p_keluar_gudang');
    }
}
