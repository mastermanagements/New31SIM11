<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationMResponMarketing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('m_respon_marketing', function (Blueprint $table) {
			$table->foreign('id_klien')->references('id')->on('a_klien');
            $table->foreign('id_promo')->references('id')->on('m_promo_marketing');
            $table->foreign('id_barang')->references('id')->on('p_barang');
            $table->foreign('id_jasa')->references('id')->on('p_jasa');
            $table->foreign('id_bagian')->references('id')->on('u_bagian_p');
            $table->foreign('id_divisi')->references('id')->on('u_devisi_p');
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
        Schema::table('m_respon_marketing', function (Blueprint $table) {
            
        });
    }
}
