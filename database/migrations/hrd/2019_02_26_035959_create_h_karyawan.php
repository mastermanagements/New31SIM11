<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHKaryawan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h_karyawan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nik')->nullable();
            $table->string('nama_ky');
            $table->string('username');
            $table->string('password');
            $table->string('tmp_lahir')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->enum('jenis_kel', ['0','1'])->nullable();
            $table->string('agama')->nullable();
            $table->enum('status_kerja',['0','1'])->nullable();
            $table->string('no_ktp')->nullable();
            $table->string('file_ktp')->nullable();
            $table->string('pas_foto')->nullable();
            $table->string('cu_vitae')->nullable();
            $table->string('nm_bank')->nullable();
            $table->string('no_rek')->nullable();
            $table->enum('gol_darah',['-','A','B','O','AB'])->nullable();
            $table->string('pend_akhir')->nullable();
            $table->string('program_studi')->nullable();
            $table->string('pt')->nullable();
            $table->integer('id_perusahaan')->unsigned();
            $table->integer('id_user_ukm')->unsigned();
            $table->date('tgl_masuk')->nullable();
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
        Schema::dropIfExists('h_karyawan');
    }
}
