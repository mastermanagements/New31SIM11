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
            $table->integer('id_barang')->unsigned();
            $table->decimal('harga_beli',12,2);//yg lama  hpp ini diganti dg harga_beli, biar tidak rancu
            $table->integer('jumlah_beli')->default(0);
            $table->integer('diskon_item')->default(0);
            $table->decimal('jumlah_harga',12,2)->default(0);
            $table->integer('id_perusahaan')->unsigned();
            $table->integer('id_karyawan')->unsigned();
            $table->foreign('id_barang')->references('id')->on('p_barang');
            $table->foreign('id_perusahaan')->references('id')->on('u_perusahaan');
            $table->foreign('id_po')->references('id')->on('p_po')->onDelete('cascade');
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
        Schema::dropIfExists('p_detail_po');
    }
}
