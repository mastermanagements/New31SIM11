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
            $table->integer('id_po')->nullable();
            $table->date('tgl_order');
            $table->string('no_order',50);
            $table->integer('id_supplier')->unsigned();
            $table->date('tgl_tiba');
            $table->decimal('diskon_tambahan',12,2)->nullable();
            $table->integer('pajak')->nullable();;
            $table->decimal('dp_po',12,2)->nullable()->default(0);
            $table->decimal('bayar',12,2)->nullable();
            $table->decimal('kurang_bayar',12,2)->nullable()->default(0);
            $table->enum('metode_bayar',['0','1'])->default(0)->comment('0=tunai,1 = kredit/hutang/cicil');
            $table->date('tgl_jatuh_tempo')->nullable();
            $table->decimal('ongkir',12,2)->nullable();
            $table->text('ket')->nullable();
            $table->decimal('total',12,2)->default(0);
            //$table->enum('status_bayar',['0','1'])->default(0)->comment('0=lunas,1 = belum lunas');
            $table->integer('id_perusahaan')->unsigned();
            $table->integer('id_karyawan')->unsigned();

            //$table->foreign('id_po')->references('id')->on('p_po')->onDelete('cascade');
            $table->foreign('id_supplier')->references('id')->on('p_supplier')->onDelete('cascade');
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
        Schema::dropIfExists('p_order');
    }
}
