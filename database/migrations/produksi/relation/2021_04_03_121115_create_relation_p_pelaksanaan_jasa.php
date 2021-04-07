<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationPPelaksanaanJasa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('p_pelaksanaan_jasa', function (Blueprint $table) {

            $table->foreign('id_detail_oj')->references('id')->on('p_detail_order_jasa')->onDelete('cascade');
            $table->foreign('id_proses_bisnis')->references('id')->on('p_proses_bisnis');
            $table->foreign('yg_mengerjakan')->references('id')->on('h_karyawan');
            $table->foreign('yg_mengkonfirmasi')->references('id')->on('h_karyawan');
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
    Schema::table('p_pelaksanaan_jasa', function (Blueprint $table) {

      });
  }
}
