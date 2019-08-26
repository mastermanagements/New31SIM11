<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationMRencanaMarketingJasa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('m_rencana_marketing_jasa', function (Blueprint $table) {
            $table->foreign('id_rencana_pend_jasa')->references('id')->on('k_rencana_pend_jasa');
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
        Schema::table('m_rencana_marketing_jasa', function (Blueprint $table) {
      
        });
    }
}
