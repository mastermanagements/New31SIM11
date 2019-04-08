<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelasiIjinUsaha extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('u_ijin_usaha', function (Blueprint $table) {
            //
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
        Schema::table('u_ijin_usaha', function (Blueprint $table) {
            //
        });
    }
}
