<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGSkalaTunjangan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('g_skala_tunjangan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_jabatan')->unsigned();
            $table->integer('id_item_tunjangan')->unsigned();
            $table->enum('status_tunjangan',[0,1])->default(0);
            $table->integer('besar_tunjangan');
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
        Schema::dropIfExists('g_skala_tunjangan');
    }
}
