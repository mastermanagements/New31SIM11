<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PDetailSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_detail_sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_sales')->unsigned();
            $table->integer('id_barang')->unsigned();
            $table->decimal('hpp',12,2)->default(0);
            $table->integer('jumlah_jual')->default(0);
            $table->integer('diskon')->default(0);
            $table->decimal('jumlah_harga', 12,2)->default(0);
            $table->integer('id_perusahaan')->unsigned();
            $table->integer('id_karyawan')->unsigned();

            $table->foreign('id_perusahaan')->references('id')->on('u_perusahaan');
            $table->foreign('id_karyawan')->references('id')->on('h_karyawan');
            $table->foreign('id_sales')->references('id')->on('p_sales');
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
        Schema::dropIfExists('p_detail_sales');
    }
}
