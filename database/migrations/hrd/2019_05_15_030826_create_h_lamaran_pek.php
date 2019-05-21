<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHLamaranPek extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h_lamaran_pek', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_loker');
            $table->string('nm_pel');
            $table->string('posisi');
            $table->enum('jenis_lamaran', [0,1,2]);
            $table->date('tgl_masuk');
            $table->string('berkas_lamaran');
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
        Schema::dropIfExists('h_lamaran_pek');
    }
}
