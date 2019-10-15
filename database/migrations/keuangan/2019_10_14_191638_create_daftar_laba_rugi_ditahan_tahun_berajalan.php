<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaftarLabaRugiDitahanTahunBerajalan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('k_laba_rugi_ditahan_tahun_berhalan', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('jumlah_laba_tahun_berjalan')->default(0);
            $table->integer('id_sub_akun')->unsigned();
            $table->year('tahun');
            $table->integer('id_perusahaan')->unsigned();
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
        Schema::dropIfExists('k_laba_rugi_ditahan_tahun_berhalan');
    }
}
