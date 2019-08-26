<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHTesKmanajerial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h_tes_kmanajerial', function (Blueprint $table) {
            $table->increments('id');
            $table->year('thn_tes_km');
            $table->integer('id_ky')->unsigned();
            $table->integer('id_kompetensi_m')->unsigned();
            $table->integer('id_item_km')->unsigned();
            $table->integer('nilai_km1');
            $table->integer('nilai_km2');
            $table->integer('nilai_km3');
            $table->integer('nilai_km4');
            $table->integer('nilai_km5');
            $table->integer('skor_akhir_km');
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
        Schema::dropIfExists('h_tes_kmanajerial');
    }
}
