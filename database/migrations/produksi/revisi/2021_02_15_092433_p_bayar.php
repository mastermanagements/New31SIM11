<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PBayar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_bayar', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('jenis_barang',['-','0','1','2'])->default('-')->comment('0=bayar PO, 1=bayar order, 2= return brg beli');
            $table->integer('id_po')->default(0)->unsigned();
            $table->integer('id_order')->default(0)->unsigned();
            $table->integer('id_return_barang')->default(0)->unsigned();
            $table->date('tgl_bayar');
            $table->enum('metode_bayar',['-','0','1','2'])->default('-')->comment('0=transfer bak, 1=cek, 2= langsung, 3=return barang');
            $table->string('bank_asal')->nullable();
            $table->string('rek_asal')->nullable();
            $table->string('bank_tujuan')->nullable();
            $table->string('no_rek_tujuan')->nullable();
            $table->decimal('jumlah_bayar',12,2)->default(0);
            $table->string('bukti_bayar')->default(0);
            $table->enum('kirim_bukti',['0','1'])->default('0');
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
        Schema::dropIfExists('p_bayar');
    }
}
