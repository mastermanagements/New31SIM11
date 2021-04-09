<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PAkunPembelian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_akun_pembelian', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jenis_jurnal')->default(0);
            $table->integer('id_ket_transaksi')->unsigned();
            $table->enum('jenis_transaksi',['0','1'])->default(0)->comment('0=penerimaan');
            $table->integer('id_akun_aktif')->unsigned();
            $table->enum('posisi_akun',['0','1'])->default(0);
            $table->integer('id_perusahaan')->unsigned();
            $table->integer('id_karyawan')->unsigned();

            $table->foreign('id_perusahaan')->references('id')->on('u_perusahaan');
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
        Schema::dropIfExists('p_akun_pembelian');
    }
}
