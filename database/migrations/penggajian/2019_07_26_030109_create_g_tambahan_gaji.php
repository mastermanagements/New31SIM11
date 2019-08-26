<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGTambahanGaji extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('g_tambahan_gaji', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_ky')->unsigned();
            $table->integer('id_slip')->unsigned();
            $table->text('keterangan');
            $table->integer('jumlah_uang');
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
        Schema::dropIfExists('g_tambahan_gaji');
    }
}
