<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationKInvestor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('k_investor', function (Blueprint $table) {
            $table->foreign('id_prov')->references('id')->on('u_provinsi');
            $table->foreign('id_kab')->references('id')->on('u_kabupaten');
            $table->foreign('id_perusahaan')->references('id')->on('u_perusahaan');
            $table->foreign('id_user_ukm')->references('id')->on('u_user_ukm');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('k_investor', function (Blueprint $table) {
            //
        });
    }
}
