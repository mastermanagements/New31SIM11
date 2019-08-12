<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIBulanDividenS extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_bulan_dividen_s', function (Blueprint $table) {
            $table->increments('id');
            $table->year('thn_dividen');
            $table->date('bln_dividen');
            $table->bigInteger('laba_rugi');
            $table->bigInteger('alokasi_kas');
            $table->bigInteger('net_kas');
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
        Schema::dropIfExists('i_bulan_dividen_s');
    }
}
