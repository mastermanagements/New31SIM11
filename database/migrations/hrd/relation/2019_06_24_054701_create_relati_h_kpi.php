<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelatiHKpi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('h_kpi', function (Blueprint $table) {
            $table->foreign('id_aku')->references('id')->on('h_aku');
            $table->foreign('id_satuan_kpi')->references('id')->on('h_satuan_kpi');
            $table->foreign('id_jenis_kpi')->references('id')->on('h_jenis_kpi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('h_kpi', function (Blueprint $table) {
            //
        });
    }
}
