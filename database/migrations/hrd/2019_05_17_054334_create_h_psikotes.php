<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHPsikotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h_psikotes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_lamaran_p')->unsigned();
            $table->date('tgl_tes');
            $table->integer('id_jenis_psikotes')->unsigned();
            $table->integer('nilai_akhir');
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
        Schema::dropIfExists('h_psikotes');
    }
}
