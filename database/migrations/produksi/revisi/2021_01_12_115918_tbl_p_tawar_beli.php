<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblPTawarBeli extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_tawar_beli', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_tawar');
            $table->date('tgl_tawar');
            $table->date('tgl_berlaku');
            $table->date('tgl_kirim');
            $table->integer('id_supplier')->unsigned();
            $table->integer('id_perusahaan')->unsigned();
            $table->foreign('id_perusahaan')->references('id')->on('u_perusahaan')->onDelete('cascade');
            $table->foreign('id_supplier')->references('id')->on('p_supplier')->onDelete('cascade');

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
        Schema::dropIfExists('p_tawar_beli');
    }
}
