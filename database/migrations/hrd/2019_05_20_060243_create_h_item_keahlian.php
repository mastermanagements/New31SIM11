<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHItemKeahlian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h_item_keahlian', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_jabatan_p')->unsigned();
            $table->string('item_tes_keahlian');
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
        Schema::dropIfExists('h_item_keahlian');
    }
}
