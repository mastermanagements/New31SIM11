<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelasiHKaryawanPelatihan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('h_karyawan_pelatihan', function (Blueprint $table) {
            $table->foreign('id_ky')->references('id')->on('h_karyawan');
            $table->foreign('id_rencana_pel')->references('id')->on('h_rencana_pelatihan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('h_karyawan_pelatihan', function (Blueprint $table) {
            //
        });
    }
}
