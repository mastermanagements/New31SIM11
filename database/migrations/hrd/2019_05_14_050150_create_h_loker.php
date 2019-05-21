<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHLoker extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h_loker', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nm_loker');
            $table->text('detail');
            $table->date('tgl_buka');
            $table->date('tgl_selesai');
            $table->integer('jumlah_pelamar');
            $table->string('file_loker');
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
        Schema::dropIfExists('h_loker');
    }
}
