<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationMenuInvestor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('u_menu_investor', function (Blueprint $table) {
            //
            $table->foreign('id_menu_ukm')->references('id')->on('u_menu_ukm');
            $table->foreign('id_submenu_ukm')->references('id')->on('u_submenu_ukm');
            $table->foreign('id_user_ukm')->references('id')->on('u_user_ukm');
            $table->foreign('id_investor')->references('id')->on('k_investor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('u_menu_investor', function (Blueprint $table) {
            //
        });
    }
}
