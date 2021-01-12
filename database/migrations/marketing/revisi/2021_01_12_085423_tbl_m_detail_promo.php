<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblMDetailPromo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_detail_promo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_promo')->unsigned();
            $table->integer('id_barang')->unsigned()->nullable();
            $table->integer('id_jasa')->unsigned()->nullable();
            $table->decimal('hpp')->unsigned()->default(0);
            $table->integer('diskon')->unsigned()->default(0);
            $table->integer('minimum_beli')->unsigned()->default(0);
            $table->integer('id_perusahaan')->unsigned();
            $table->foreign('id_promo')->references('id')->on('m_promo')->onDelete('cascade');
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
        Schema::dropIfExists('m_detail_promo');
    }
}
