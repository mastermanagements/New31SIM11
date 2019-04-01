<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHKeluargaKy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h_keluarga_ky', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_ky')->unsigned();
            $table->string('nm_ayah');
            $table->enum('status_a', ['0','1']);
            $table->string('nm_ibu');
            $table->enum('status_i', ['0','1']);
            $table->integer('jum_saudara');
            $table->integer('anak_ke');
            $table->string('cp_darurat');
            $table->string('telp_darurat');
            $table->string('file_kk')->nullable();
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
        Schema::dropIfExists('h_keluarga_ky');
    }
}
