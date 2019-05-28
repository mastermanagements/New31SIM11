<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePJadwalProyek extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_jadwal_proyek', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_task_p')->unsigned();
            $table->integer('id_rincian_p')->unsigned();
            $table->integer('durasi');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
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
        Schema::dropIfExists('p_jadwal_proyek');
    }
}
