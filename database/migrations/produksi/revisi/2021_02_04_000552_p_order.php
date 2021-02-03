<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class POrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_order', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_po')->unsigned()->default(0);
            $table->date('tgl_order');
            $table->integer('no_order')->nullable();
            $table->integer('id_supplier')->unsigned();
            $table->date('tgl_tiba');
            $table->integer('diskon_tambahan')->unsigned();
            $table->integer('pajak');
            $table->decimal('dp_po',12,2);
            $table->decimal('bayar',12,2);
            $table->decimal('kurang_bayar',12,2);
            $table->enum('metode_bayar',['0','1'])->default(0)->comment('0=tunai,1 = kredit/hutang/cicil');
            $table->date('tgl_jatuh_tempo');
            $table->date('expired_date');
            $table->decimal('ongkir',12,2);
            $table->text('ket');

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
        Schema::dropIfExists('p_order');
    }
}
