<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblPStokOpname extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_stok_opname', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tgl_so');
            $table->integer('id_barang')->unsigned();
            $table->decimal('stok_akhir');
            $table->decimal('bukti_fisik');
            $table->decimal('selisih');
            $table->string('petugas');
            $table->integer('id_perusahaan')->unsigned();
            $table->integer('id_karyawan')->unsigned();
            $table->foreign('id_barang')->references('id')->on('p_barang')->onDelete('cascade');
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
        Schema::dropIfExists('p_stok_opname');
    }
}
