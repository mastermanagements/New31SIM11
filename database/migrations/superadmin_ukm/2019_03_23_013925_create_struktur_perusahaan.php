<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStrukturPerusahaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('struktur_perusahaan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parentId')->nullable()->unsigned();
            $table->integer('id_karyawan')->unsigned();
            $table->integer('id_jabatan')->unsigned();
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
        Schema::dropIfExists('struktur_perusahaan');
    }
}
