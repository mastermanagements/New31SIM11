<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAAgendaHarian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('a_agenda_harian', function (Blueprint $table) {
            $table->increments('id');
			$table->date('tgl_agenda');
			$table->integer('id_jobdesc')->nullable()->unsigned();
			$table->integer('id_target_bulanan')->nullable()->unsigned();
			$table->text('agenda');
			$table->integer('id_perusahaan')->unsigned();
			$table->integer('id_karyawan')->unsigned();
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
        Schema::dropIfExists('a_agenda_harian');
    }
}
