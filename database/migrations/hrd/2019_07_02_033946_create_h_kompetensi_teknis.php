<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHKompetensiTeknis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h_kompetensi_teknis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_jenis_kompetensi')->unsigned();
            $table->integer('id_jabatan')->unsigned();
            $table->string('nm_kompetensi_t');
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
        Schema::dropIfExists('h_kompetensi_teknis');
    }
}
