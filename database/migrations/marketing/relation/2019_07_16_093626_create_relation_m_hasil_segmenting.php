<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationMHasilSegmenting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('m_hasil_segmenting', function (Blueprint $table) {
            //$table->foreign('id_barang')->references('id')->on('p_barang');
            //$table->foreign('id_jasa')->references('id')->on('p_jasa');
            $table->foreign('id_segmenting')->references('id')->on('m_segmenting');
            //$table->foreign('id_sub_segmenting')->references('id')->on('m_sub_segmenting');
            //$table->foreign('id_subsub_segmenting')->references('id')->on('m_subsub_segmenting');
            //$table->foreign('id_content_segmenting')->references('id')->on('m_content_segmenting');
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
        Schema::table('m_hasil_segmenting', function (Blueprint $table) {
		});	
    }
}
