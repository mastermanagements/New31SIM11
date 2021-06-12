<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmenuUkm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('u_submenu_ukm', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_menu_ukm')->unsigned();
            $table->integer('id_master_submenu')->unsigned();
			$table->integer('urutan')->default('0')->nullable();
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
        Schema::dropIfExists('u_submenu_ukm');
    }
}
