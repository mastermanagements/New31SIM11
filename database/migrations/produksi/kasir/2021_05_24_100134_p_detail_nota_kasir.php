<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PDetailNotaKasir extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_detail_nota_kasir', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_nota_kasir');
            $table->unsignedInteger('id_barang');
            $table->decimal('jumlah_jual');
            $table->decimal('harga_satuan');
            $table->decimal('sub_total');
            $table->timestamps();
            $table->foreign('id_nota_kasir')->references('id')->on('p_nota_kasir')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('p_detail_nota_kasir');
    }
}
