<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePJualBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_jual_barang', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tgl_jual');
            $table->integer('id_barang')->unsigned();
            $table->integer('id_klien')->unsigned();
            $table->integer('jumlah_barang');
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
        Schema::dropIfExists('p_jual_barang');
    }
}
