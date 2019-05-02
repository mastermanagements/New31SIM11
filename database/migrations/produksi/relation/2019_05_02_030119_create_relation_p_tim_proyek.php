<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationPTimProyek extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('p_tim_proyek', function (Blueprint $table) {
            //
            $table->foreign('id_proyek')->references('id')->on('p_proyek');
            $table->foreign('id_ky')->references('id')->on('h_karyawan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('p_tim_proyek', function (Blueprint $table) {
            //
        });
    }
}
