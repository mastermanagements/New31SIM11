<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateASpk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('a_spk', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_spk');
            $table->date('tgl_spk');
            $table->integer('id_klien')->unsigned();
            $table->string('nm_spk');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->string('alamat');
            $table->integer('id_prov')->unsigned();
            $table->integer('id_kab')->unsigned();
            $table->string('file_kotrak')->nullable();
            $table->string('file_scan')->nullable();
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
        Schema::dropIfExists('a_spk');
    }
}
