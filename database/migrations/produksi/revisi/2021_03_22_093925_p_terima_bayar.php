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
            $table->string('bank_asal');
            $table->string('rek_asal');
            $table->string('bank_tujuan');
            $table->string('no_rek_tujuan');
            $table->string('jumlah_bayar');
            $table->enum('terima_bukti',['-','0','1'])->default('-')->comment('-=default, 0=uang belum masuk, 1= uang sudah masuk');
            $table->integer('id_perusahaan')->unsigned();
            $table->integer('id_karyawan')->default(0);
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
        Schema::dropIfExists('p_terima_bayar');
    }
}
