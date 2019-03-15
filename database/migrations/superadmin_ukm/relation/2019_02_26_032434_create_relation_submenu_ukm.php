<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationSubmenuUkm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('u_submenu_ukm', function (Blueprint $table) {
            //
            $table->foreign('id_menu_ukm')->references('id')->on('u_menu_ukm');
            $table->foreign('id_master_submenu')->references('id')->on('u_master_submenu');
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
        Schema::table('u_submenu_ukm', function (Blueprint $table) {
            //
        });
    }
}
