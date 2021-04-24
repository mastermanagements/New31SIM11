<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PReturnPenjualan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_return_penjualan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_complain_barang')->unsigned();
            $table->date('tgl_return');
            $table->enum('jenis_return',['0','1','2'])->comment('0=return barang, 1=return uang, 2=potong hutang');
            $table->decimal('ongkir_return',12,2)->default(0);
            $table->enum('konfirm',['0','1'])->default(0)->comment('0=belum, 1= sudah');
            $table->enum('status_return',['0','1'])->default(0);
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
        Schema::dropIfExists('p_return_penjualan');
    }
}
