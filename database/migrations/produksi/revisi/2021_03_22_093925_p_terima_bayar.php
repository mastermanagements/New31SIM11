<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PTerimaBayar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_terima_bayar', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('jenis_bayar',['-','0','1','3'])->default('-')->comment('0=bayar so, 1=bayar sales, 3=return barang jual');
            $table->integer('id_so')->unsigned()->default(0);
            $table->integer('id_sales')->unsigned()->default(0);
            $table->integer('id_return_barang')->unsigned()->default(0);
            $table->date('tgl_bayar');
            $table->enum('metode_bayar',['-','0','1','2'])->default('-')->comment('0=transfer bank, 1=cek, 2 = langsung/tunai, 3=return barang jual');
            $table->integer('bank_asal')->unsigned();
            $table->integer('bank_tujuan')->unsigned();
            $table->decimal('jumlah_bayar',12,2)->default(0);
            $table->enum('terima_bukti',['-','0','1'])->default('-')->comment('-=default, 0=uang belum masuk, 1= uang sudah masuk');
            $table->integer('id_perusahaan')->unsigned();
            $table->integer('id_karyawan')->unsigned();

            $table->foreign('id_perusahaan')->references('id')->on('u_perusahaan');
            $table->foreign('id_karyawan')->references('id')->on('h_karyawan');
            $table->foreign('id_so')->references('id')->on('p_so');
            $table->foreign('id_sales')->references('id')->on('p_sales');
            $table->foreign('id_return_barang')->references('id')->on('p_return_penjualan');
            $table->foreign('bank_asal')->references('id')->on('p_rek_klien');
            $table->foreign('bank_tujuan')->references('id')->on('p_rek_ukm');
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
        Schema::dropIfExists('p_terima_bayar');
    }
}
