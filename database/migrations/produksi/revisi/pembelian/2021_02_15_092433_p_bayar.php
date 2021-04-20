<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PBayar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_bayar', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('jenis_bayar',['-','0','1','2'])->default('-')->comment('0=bayar PO, 1=bayar order, 2= return brg beli');
            $table->integer('id_po')->nullable();
            $table->integer('id_order')->nullable();
            $table->integer('id_return_barang')->nullable();
            $table->date('tgl_bayar');
            $table->enum('metode_bayar',['-','0','1','2'])->default('-')->comment('0=transfer bak, 1=cek, 2= langsung, 3=return barang');
            $table->integer('bank_asal')->unsigned();
            $table->integer('bank_tujuan')->unsigned();
            $table->decimal('jumlah_bayar',12,2)->default(0);
            $table->string('bukti_bayar')->default(0);
            $table->enum('kirim_bukti',['0','1'])->default('0')->comment('0= blm konfirm pembayaran, 1 = sdh konfirm pembayaran');
            $table->integer('id_perusahaan')->unsigned();
            $table->integer('id_karyawan')->unsigned();

            $table->foreign('id_perusahaan')->references('id')->on('u_perusahaan');
            $table->foreign('id_karyawan')->references('id')->on('h_karyawan');
            $table->foreign('id_po')->references('id')->on('p_po');
            $table->foreign('id_order')->references('id')->on('p_order');
            $table->foreign('id_return_barang')->references('id')->on('p_return_pembelian');
            $table->foreign('bank_asal')->references('id')->on('p_rek_ukm');
            $table->foreign('bank_tujuan')->references('id')->on('p_rek_supplier');
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
        Schema::dropIfExists('p_bayar');
    }
}
