<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PDetailTj extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_detail_tj', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_tawar_jual')->unsigned();
            $table->integer('id_barang')->default(0);
            $table->integer('id_jasa')->default(0);
            $table->decimal('hpp',12,2)->default(0);
            $table->integer('jumlah_barang')->default(0);
            $table->integer('diskon')->unsigned();
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
        Schema::dropIfExists('p_detail_tj');
    }
}