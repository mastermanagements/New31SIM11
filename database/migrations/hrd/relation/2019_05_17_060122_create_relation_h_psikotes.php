<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationHPsikotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('h_psikotes', function (Blueprint $table) {
            //
            $table->foreign('id_jenis_psikotes')->references('id')->on('h_jenis_psikotes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('h_psikotes', function (Blueprint $table) {
            //
        });
    }
}
