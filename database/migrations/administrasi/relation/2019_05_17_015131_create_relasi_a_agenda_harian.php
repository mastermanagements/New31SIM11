<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelasiAAgendaHarian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('a_agenda_harian', function (Blueprint $table) {
			$table->foreign('id_jobdesc')->references('id')->on('u_job_desc');
			$table->foreign('id_target_bulanan')->references('id')->on('u_target_bulanan');
            $table->foreign('id_perusahaan')->references('id')->on('u_perusahaan');
			$table->foreign('id_karyawan')->references('id')->on('h_karyawan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('a_agenda_harian', function (Blueprint $table) {
            //
        });
    }
}
