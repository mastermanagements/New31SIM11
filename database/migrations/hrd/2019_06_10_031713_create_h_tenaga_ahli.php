<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHTenagaAhli extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h_tenaga_ahli', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_ky')->unsigned();
            $table->string('lembaga_sertifikasi');
            $table->string('no_sertifikat');
            $table->string('klasifikasi');
            $table->string('no_registrasi');
            $table->string('ditetapkan');
            $table->date('tgl_penetapan');
            $table->integer('masa_berlaku');
            $table->string('asosiosi');
            $table->string('no_anggota');
            $table->string('posisi_proyek');
            $table->integer('id_perusahaan');
            $table->integer('id_karyawan');
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
        Schema::dropIfExists('h_tenaga_ahli');
    }
}
