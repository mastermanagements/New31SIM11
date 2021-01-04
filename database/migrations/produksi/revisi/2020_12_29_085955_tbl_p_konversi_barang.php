<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblPKonversiBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_konversi_barang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_barang_asal')->unsigned();
            $table->integer('id_barang_tujuan')->unsigned();
            $table->integer('jumlah_konversi_satuan')->unsigned();
            $table->integer('id_perusahaan')->unsigned();
            $table->foreign('id_barang_asal')->references('id')->on('p_barang')->onDelete('cascade');
            $table->foreign('id_barang_tujuan')->references('id')->on('p_barang')->onDelete('cascade');
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
        Schema::dropIfExists('p_konversi_barang');
    }
}
