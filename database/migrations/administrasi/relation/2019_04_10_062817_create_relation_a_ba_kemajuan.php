<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationABaKemajuan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('a_ba_kemajuan', function (Blueprint $table) {
            //
            $table->foreign('id_spk')->references('id')->on('a_spk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('a_ba_kemajuan', function (Blueprint $table) {
            //
        });
    }
}
