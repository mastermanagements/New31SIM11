<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PDetailCekBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_detail_cek_barang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_order')->unsigned();
            $table->integer('id_cek_barang')->unsigned();
            $table->integer('id_barang')->unsigned();
            $table->integer('harga_beli');//yg lama hpp, diganti harga beli (biar tdk rancu, krn hpp adanya di p_barang.hpp), di ambil dari p_detail_order.harga_beli
            $table->integer('jumlah_beli');
            $table->integer('diskon_item')->nullable();
            $table->decimal('jumlah_harga',12,2);
            //$table->enum('cek_jumlah', ['0','1'])->comment('0=sesuai, 1=tidak sesuai');
            $table->integer('jum_sesuai');
            $table->integer('jum_no_sesuai');
            //$table->enum('cek_kualitas', ['0','1'])->comment('0=sesuai, 1=tidak sesuai');
            $table->integer('jum_kualitas_sesuai');
            $table->integer('jum_kualitas_no_sesuai');
            $table->text('ket')->nullable();
            $table->enum('status_return',['0','1'])->comment('0=diterima, 1=ditolak')->nullable();
            $table->text('alasan_ditolak')->nullable();
            $table->integer('id_perusahaan')->unsigned();
            $table->integer('id_karyawan')->unsigned();

            $table->foreign('id_perusahaan')->references('id')->on('u_perusahaan');
            $table->foreign('id_karyawan')->references('id')->on('h_karyawan');
            $table->foreign('id_order')->references('id')->on('p_order')->onDelete('cascade');
            $table->foreign('id_cek_barang')->references('id')->on('p_cek_barang')->onDelete('cascade');
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
        Schema::dropIfExists('p_detail_cek_barang');
    }
}
