<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHTesKeahlian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h_tes_keahlian', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_lamaran_p')->unsigned();
            $table->integer('id_item_tes_keahlian')->unsigned();
            $table->integer('nilai_akhir');
            $table->text('ket');
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
        Schema::dropIfExists('h_tes_keahlian');
    }
}
