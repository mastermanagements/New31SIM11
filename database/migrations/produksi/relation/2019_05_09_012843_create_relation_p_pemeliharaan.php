<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationPPemeliharaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('p_pemeliharaan', function (Blueprint $table) {
            //
            $table->foreign('id_jasa')->references('id')->on('p_jasa');
            $table->foreign('id_jenis_pem')->references('id')->on('p_jenis_pem');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('p_pemeliharaan', function (Blueprint $table) {
            //
        });
    }
}
