<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTesHKteknis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h_tes_kteknis', function (Blueprint $table) {
            $table->increments('id');
            $table->year('thn_tes_kt');
            $table->integer('id_ky')->unsigned();
            $table->integer('id_kompetensi_t')->unsigned();
            $table->integer('id_item_kt')->unsigned();
            $table->integer('nilai_kt');
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
        Schema::dropIfExists('h_tes_kteknis');
    }
}
