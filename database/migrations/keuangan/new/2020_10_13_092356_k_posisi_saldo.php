<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KPosisiSaldo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('k_posisi_saldo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_akun')->unsigned();
            $table->integer('id_sub_akun')->unsigned();
            $table->integer('id_sub_sub_akun')->unsigned();
            $table->enum('posisi_saldo',['d','k'])->default('d');
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
        Schema::dropIfExists('k_posisi_saldo');
    }
}
