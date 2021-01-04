<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePKonversiBrg extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_konversi_brg', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_barang_asal')->unsigned();
            $table->integer('id_satuan_brg_asal')->unsigned();
            $table->integer('id_barang_tujuan')->unsigned();
            $table->integer('id_satuan_brg_tujuan')->unsigned();
            $table->integer('jumlah_konversi_brg');
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
        Schema::dropIfExists('p_konversi_brg');
    }
}
