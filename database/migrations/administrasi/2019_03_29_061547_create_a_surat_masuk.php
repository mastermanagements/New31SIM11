<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateASuratMasuk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('a_surat_masuk', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tgl_surat_masuk');
            $table->string('hal');
            $table->string('dari');
            $table->integer('ditujukan')->unsigned();
            $table->string('file_surat');
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
        Schema::dropIfExists('a_surat_masuk');
    }
}
