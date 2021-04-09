<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PDiskon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_diskon', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_group')->unsigned();
            $table->enum('jenis_diskon',['0','1'])->default(0)->comment('0=berdasarkan jumlah pembelian, 1 =diskon member');
            $table->integer('jumlah_maks_beli')->default();
            $table->integer('diskon_persen')->default(0);
            $table->decimal('diskon_nominal',12,2)->default(0);
            $table->integer('id_perusahaan')->unsigned();
            $table->integer('id_karyawan')->default(0);
            $table->foreign('id_perusahaan')->references('id')->on('u_perusahaan')->onDelete('cascade');
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
        Schema::dropIfExists('p_diskon');
    }
}
