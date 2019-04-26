<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationPJualJasa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('p_jual_jasa', function (Blueprint $table) {
            $table->foreign('id_jasa')->references('id')->on('p_jasa');
            $table->foreign('id_klien')->references('id')->on('a_klien');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('p_jual_jasa', function (Blueprint $table) {
            //
        });
    }
}
