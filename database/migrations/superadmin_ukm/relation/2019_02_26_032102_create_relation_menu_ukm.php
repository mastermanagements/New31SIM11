<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationMenuUkm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('u_menu_ukm', function (Blueprint $table) {
            $table->foreign('id_master_menu')->references('id')->on('u_master_menu');
            $table->foreign('id_perusahaan')->references('id')->on('u_perusahaan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('u_menu_ukm', function (Blueprint $table) {
            //
        });
    }
}
