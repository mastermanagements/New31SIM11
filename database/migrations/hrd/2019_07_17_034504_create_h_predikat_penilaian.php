<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHPredikatPenilaian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h_predikat_penilaian', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('skor_awal');
            $table->integer('skor_akhir');
            $table->string('predikat');
            $table->integer('kenaikan');
            $table->text('fasilitas_lain')->nullable();
            $table->integer('id_perusahaan');
            $table->integer('id_karyawan');
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
        Schema::dropIfExists('h_predikat_penilaian');
    }
}
