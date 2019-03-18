<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUMenuInvestor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('u_menu_investor', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_menu_ukm')->unsigned();
            $table->integer('id_submenu_ukm')->unsigned();
            $table->integer('id_investor')->unsigned();
            $table->integer('id_user_ukm')->unsigned();
            $table->enum('status_akses',['0','1'])->default('0');
            $table->integer('id_perusahaan')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('u_menu_investor');
    }
}
