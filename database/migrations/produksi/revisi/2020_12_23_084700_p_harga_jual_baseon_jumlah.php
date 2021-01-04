<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PHargaJualBaseonJumlah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_harga_jual_baseon_jumlah', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_barang')->unsigned();
            $table->integer('jumlah_maks_brg')->unsigned();
            $table->decimal('harga_jual');
            $table->integer('id_karyawan')->unsigned();
            $table->integer('id_perusahaan')->unsigned();
            $table->integer('no_urut')->unsigned();
            $table->timestamps();
            $table->foreign('id_barang')->references('id')->on('p_barang')->onDelete('cascade');
            $table->foreign('id_perusahaan')->references('id')->on('u_perusahaan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('p_harga_jual_baseon_jumlah');
    }
}
