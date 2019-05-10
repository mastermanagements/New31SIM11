<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationPProgressPemeliharaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('p_progres_pemeliharaan', function (Blueprint $table) {
            //
            $table->foreign('id_pemeliharaan')->references('id')->on('p_pemeliharaan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('p_progres_pemeliharaan', function (Blueprint $table) {
            //
        });
    }
}
