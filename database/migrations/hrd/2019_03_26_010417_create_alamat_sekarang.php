<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlamatSekarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h_alamat_sek', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_ky')->unsigned();
            $table->text('alamat_sek');
            $table->integer('id_prov')->unsigned();
            $table->integer('id_kab')->unsigned();
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
        Schema::dropIfExists('h_alamat_sek');
    }
}