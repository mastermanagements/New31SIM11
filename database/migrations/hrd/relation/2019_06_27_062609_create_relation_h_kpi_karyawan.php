<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationHKpiKaryawan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('h_kpi_karyawan', function (Blueprint $table) {
            //
            $table->foreign('id_ky')->references('id')->on('h_karyawan');
            $table->foreign('id_aku')->references('id')->on('h_aku');
            $table->foreign('id_kpi')->references('id')->on('h_kpi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('h_kpi_karyawan', function (Blueprint $table) {
            //
        });
    }
}
