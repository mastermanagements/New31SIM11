<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableRelasiUkmPerusahaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('u_perusahaan', function (Blueprint $table) {
            $table->foreign('id_prov')->references('id')->on('u_provinsi');
            $table->foreign('id_kab')->references('id')->on('u_kabupaten');
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
        Schema::table('u_perusahaan', function (Blueprint $table) {
            //
        });
    }
}
