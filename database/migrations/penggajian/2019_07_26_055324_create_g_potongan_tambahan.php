<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGPotonganTambahan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('g_potongan_tambahan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_ky')->unsigned();
            $table->integer('id_slip')->unsigned();
            $table->string('keterangan');
            $table->integer('jumlah_potongan');
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
        Schema::dropIfExists('g_potongan_tambahan');
    }
}
