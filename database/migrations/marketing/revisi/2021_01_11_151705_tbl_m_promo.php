<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblMPromo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_promo', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('jenis_promo',['0','1'])->comment('0=promo barang, 1=promo jasa');
            $table->text('nama_promo');
            $table->text('syarat');
            $table->text('fasilitas_promo');
            $table->date('tgl_dibuat');
            $table->date('tgl_berlaku');
            $table->integer('id_perusahaan')->unsigned();
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
        Schema::dropIfExists('m_promo');
    }
}
