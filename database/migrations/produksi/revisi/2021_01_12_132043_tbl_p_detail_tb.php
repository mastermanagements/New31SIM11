<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblPDetailTb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_detail_tb', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_tawar')->unsigned();
            $table->integer('id_barang')->unsigned();

            $table->decimal('hpp_baru')->unsigned();
            $table->integer('jumlah_beli')->unsigned();

            $table->foreign('id_barang')->references('id')->on('p_barang')->onDelete('cascade');
            $table->foreign('id_tawar')->references('id')->on('p_tawar_beli')->onDelete('cascade');
            $table->integer('id_perusahaan')->unsigned();
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
        Schema::dropIfExists('p_detail_tb');
    }
}
