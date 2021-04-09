<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PReturnPembelian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_return_pembelian', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_cek_barang')->unsigned();
            $table->date('tgl_return');
            $table->enum('jenis_return',['-','0','1','2'])->default('-')->comment('0=return barang, 1=return uang, 2=potong hutang');
            $table->decimal('ongkir_return',12,2)->default(0);
            $table->enum('konfirm',['0','1'])->default(0)->comment('0=belum, 1=sudah');
            $table->enum('status_return',['0','1'])->default(0)->comment('0=open, 1=close');
            $table->integer('id_perusahaan')->unsigned();
            $table->integer('id_karyawan')->unsigned();

            $table->foreign('id_cek_barang')->references('id')->on('p_cek_barang')->onDelete('cascade');
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
        Schema::dropIfExists('p_return_pembelian');
    }
}
