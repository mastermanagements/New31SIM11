<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PDetailOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_detail_order', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_order')->unsigned();
            $table->integer('id_barang')->unsigned();
            $table->decimal('harga_beli',12,2);//yg lama  hpp ini diganti dg harga_beli, biar tidak rancu,
            $table->integer('jumlah_beli')->default(0);
            $table->integer('diskon_item')->default(0);
            $table->decimal('jumlah_harga',12,2)->default(0);
            $table->date('expired_date')->nullable();
            $table->integer('id_perusahaan')->unsigned();
            $table->integer('id_karyawan')->unsigned();

            $table->foreign('id_perusahaan')->references('id')->on('u_perusahaan');
            $table->foreign('id_karyawan')->references('id')->on('h_karyawan');
            $table->foreign('id_order')->references('id')->on('p_order');
            $table->foreign('id_barang')->references('id')->on('p_barang');
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
        Schema::dropIfExists('p_detail_order');
    }
}
