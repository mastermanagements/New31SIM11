<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationBrifing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('a_rapat', function (Blueprint $table) {
            //
            $table->foreign('id_ub')->references('id')->on('a_usulan_brifing');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('a_rapat', function (Blueprint $table) {
            //
        });
    }
}
