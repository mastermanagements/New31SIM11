<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationPDetailOrderJasa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('p_detail_order_jasa', function (Blueprint $table) {
          $table->foreign('id_order_jasa')->references('id')->on('p_order_jasa')->onDelete('cascade');;
          $table->foreign('id_jasa')->references('id')->on('p_jasa');
          $table->foreign('id_barang')->references('id')->on('p_barang');
          //$table->foreign('biaya')->references('id')->on('p_jasa');
          $table->foreign('id_perusahaan')->references('id')->on('u_perusahaan');
          $table->foreign('id_karyawan')->references('id')->on('h_karyawan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('p_detail_order_jasa', function (Blueprint $table) {

      });
    }
}
