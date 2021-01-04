<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblPHistoryKonversiBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_history_konversi_brg', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_konversi_brg')->unsigned();

            $table->date('tgl_konversi');
            $table->integer('jum_brg_dikonversi');
            $table->integer('id_perusahaan')->unsigned();
            $table->foreign('id_konversi_brg')->references('id')->on('p_konversi_barang')->onDelete('cascade');
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
        Schema::dropIfExists('p_history_konversi_brg');
    }
}
