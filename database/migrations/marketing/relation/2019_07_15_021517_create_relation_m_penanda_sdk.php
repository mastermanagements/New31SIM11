<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationMPenandaSdk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('m_penanda_sdk', function (Blueprint $table) {
             $table->foreign('id_sdk')->references('id')->on('m_sumber_data_klien');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_penanda_sdk', function (Blueprint $table) {
            //
        });
    }
}
