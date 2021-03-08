<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PHistorySaldoAkhir extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_history_saldo_akhir', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_barang')->unsigned();
            $table->date('tgl_transaksi');
            $table->integer('id_order')->nullable();
            $table->integer('id_detail_order')->nullable();
            $table->integer('id_sales')->nullable();
            $table->integer('jumlah')->default(0);
            $table->integer('harga_satuan')->default(0);
            $table->integer('id_perusahaan')->unsigned();
            $table->integer('id_karyawan');
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
        Schema::dropIfExists('p_history_saldo_akhir');
    }
}
