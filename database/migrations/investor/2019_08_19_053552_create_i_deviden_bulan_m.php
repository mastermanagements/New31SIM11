<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIDevidenBulanM extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_deviden_bulan_m', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_periode_invest')->unsigned();
            $table->year('thn_dividen');
            $table->integer('bln_dividen');
            $table->bigInteger('laba_rugi');
            $table->bigInteger('alokasi_kas');
            $table->bigInteger('net_kas');
            $table->bigInteger('nisbah_pemodal');
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
        Schema::dropIfExists('i_deviden_bulan_m');
    }
}
