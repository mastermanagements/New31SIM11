<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PTawarJual extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_tawar_jual', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_promo')->default(0);
            $table->string('no_tawar',40)->nullable();
            $table->date('tgl_tawar');
            $table->date('tgl_berlaku');
            $table->date('tgl_krm');
            $table->integer('id_klien')->unsigned();
            $table->text('ket')->nullable();
            $table->integer('id_perusahaan')->unsigned();
            $table->integer('id_karyawan')->unsigned();
            
            $table->foreign('id_perusahaan')->references('id')->on('u_perusahaan');
            $table->foreign('id_karyawan')->references('id')->on('h_karyawan');
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
        Schema::dropIfExists('p_tawar_jual');
    }
}
