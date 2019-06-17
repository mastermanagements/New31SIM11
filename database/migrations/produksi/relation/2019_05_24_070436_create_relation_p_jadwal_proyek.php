<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationPJadwalProyek extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('p_jadwal_proyek', function (Blueprint $table) {
            //
            $table->foreign('id_task_p')->references('id')->on('p_task_proyek');
            $table->foreign('id_rincian_p')->references('id')->on('p_rincian_tugas');
			
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('p_jadwal_proyek', function (Blueprint $table) {
            //
        });
    }
}
