<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PDetailSo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_detail_so', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_so')->unsigned();
            $table->integer('id_barang')->unsigned();
            $table->decimal('hpp',12,2)->default(0);
            $table->decimal('jumlah_jual',12,2)->default(0);
            $table->integer('diskon')->default(0);
            $table->decimal('jumlah_harga',12,2)->default(0);
            $table->integer('id_perusahaan')->unsigned();
            $table->integer('id_karyawan')->unsigned()->default(0);
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
        Schema::dropIfExists('p_detail_so');
    }
}
