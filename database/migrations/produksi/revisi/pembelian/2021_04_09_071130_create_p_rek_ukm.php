<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePRekUkm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_rek_ukm', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_bank',40);
            $table->string('no_rek',40);
            $table->string('atas_nama');
            $table->string('kcp')->nullable();
            $table->integer('id_perusahaan')->unsigned();
            $table->integer('id_user_ukm')->unsigned();

            $table->foreign('id_perusahaan')->references('id')->on('u_perusahaan');
            $table->foreign('id_user_ukm')->references('id')->on('u_user_ukm');
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
        Schema::dropIfExists('p_rek_ukm');
    }
}
