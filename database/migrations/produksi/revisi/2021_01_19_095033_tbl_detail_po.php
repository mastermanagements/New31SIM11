<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblDetailPo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_detail_po', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_po')->unsigned();
            $table->foreign('id_po')->references('id')->on('tbl_p_po')->onDelete('cascade');

            $table->integer('id_barang')->unsigned();
            $table->integer('hpp')->unsigned();
            $table->integer('jumlah_beli')->unsigned();
            $table->integer('diskon_item')->unsigned()->default(0);
            $table->integer('jumlah_harga')->unsigned();

            $table->integer('id_perusahaan')->unsigned();
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
        Schema::dropIfExists('p_detail_po');
    }
}
