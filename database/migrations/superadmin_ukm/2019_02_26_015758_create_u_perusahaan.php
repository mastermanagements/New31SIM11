<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUPerusahaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('u_perusahaan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nm_usaha');
            $table->string('alamat',200);
            $table->integer('id_prov')->unsigned();
            $table->integer('id_kab')->unsigned();
            $table->string('kode_pos');
            $table->string('telp')->nullable();
            $table->string('hp')->nullable();
            $table->string('wa')->nullable();
            $table->string('teleg')->nullable();
            $table->string('email');
            $table->string('jenis_usaha',255);
            $table->string('logo');
            $table->integer('id_user_ukm')->unsigned();
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
        Schema::dropIfExists('u_perusahaan');
    }
}
