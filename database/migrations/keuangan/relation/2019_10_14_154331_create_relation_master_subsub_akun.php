<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationMasterSubsubAkun extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('k_master_subsub_akun', function (Blueprint $table) {
            $table->foreign('id_m_sub_akun')->references('id')->on('k_master_sub_akun');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('k_master_subsub_akun', function (Blueprint $table) {
		 });
    }
}
