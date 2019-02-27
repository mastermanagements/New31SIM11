<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKInvestor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('k_investor', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nm_investor');
            $table->string('no_ktp');
            $table->string('password');
            $table->string('alamat',255);
            $table->integer('id_prov')->unsigned();
            $table->integer('id_kab')->unsigned();
            $table->string('hp');
            $table->string('wa');
            $table->string('jum_saham');
            $table->string('file_ktp');
            $table->string('nm_ahli_waris');
            $table->string('no_hp_aw');
            $table->string('alamat_aw',255);
            $table->integer('id_perusahaan')->unsigned();
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
        Schema::dropIfExists('k_investor');
    }
}
