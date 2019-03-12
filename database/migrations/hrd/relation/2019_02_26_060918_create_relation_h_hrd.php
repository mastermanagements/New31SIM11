<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationHHrd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('h_karyawan', function (Blueprint $table) {
            //
            $table->foreign('id_perusahaan')->references('id')->on('u_perusahaan');
            $table->foreign('id_user_ukm')->references('id')->on('u_user_ukm');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('u_menu_karyawan', function (Blueprint $table) {
            //
        });
    }
}
