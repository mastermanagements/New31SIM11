<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUMasterSubmenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('u_master_submenu', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_master_menu')->unsigned();
            $table->string('nm_submenu');
			$table->integer('urutan')->default('0')->nullable();
			$table->string('url');
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
        Schema::dropIfExists('u_master_submenu');
    }
}
