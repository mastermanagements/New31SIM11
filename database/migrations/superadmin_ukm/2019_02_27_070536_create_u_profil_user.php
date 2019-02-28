<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUProfilUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('u_profil', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user_ukm')->unsigned();
            $table->string('telp')->nullable();
            $table->string('hp');
            $table->string('wa');
            $table->string('telegram')->nullable();
            $table->integer('provinsi_id')->unsigned();
            $table->integer('kab_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('u_profil', function (Blueprint $table){
            $table->foreign('id_user_ukm')->references('id')->on('u_user_ukm');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('u_profil');
    }
}
