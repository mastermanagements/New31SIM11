<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationProgressProyek extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('p_progress_proyek', function (Blueprint $table) {
            //
            $table->foreign('id_jadwal_proyek')->references('id')->on('p_jadwal_proyek');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('p_progress_proyek', function (Blueprint $table) {
            //
        });
    }
}
