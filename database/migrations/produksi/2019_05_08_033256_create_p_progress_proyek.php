<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePProgressProyek extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_progress_proyek', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_jadwal_proyek')->unsigned();
            $table->date('tgl_dikerjakan');
            $table->text('masalah')->nullable();
            $table->text('solusi')->nullable();
            $table->text('rincian_pekerjaan');
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
        Schema::dropIfExists('p_progress_proyek');
    }
}
