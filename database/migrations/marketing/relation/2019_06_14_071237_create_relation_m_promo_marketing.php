<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationMPromoMarketing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('m_promo_marketing', function (Blueprint $table) {
            $table->foreign('id_rencana_marketing_brg')->references('id')->on('m_rencana_marketing_brg');
            $table->foreign('id_rencana_marketing_jasa')->references('id')->on('m_rencana_marketing_jasa');
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
        Schema::table('m_promo_marketing', function (Blueprint $table) {
            
        });
    }
}
