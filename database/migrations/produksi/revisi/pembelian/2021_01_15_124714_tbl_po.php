<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblPo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_po', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_tawar_beli')->nullable();
            $table->date('tgl_po');
            $table->string('no_po');
            $table->integer('id_supplier')->unsigned();
            $table->date('tgl_krm')->nullable();
            $table->decimal('diskon_tambahan',12,2)->nullable()>default(0);
            $table->integer('pajak')->nullable()>default(0);
            $table->decimal('dp_po',12,2)->nullable()->default(0);
            $table->decimal('kurang_bayar',12,2)->nullable()->default(0);
            $table->text('ket')->nullable();
            $table->enum('status_po',['0','1'])->default(0)->comment('0=open, 1=close');
            $table->decimal('total',12,2)->default(0);
            $table->integer('id_perusahaan')->unsigned();
            $table->integer('id_karyawan')->unsigned();
            $table->timestamps();
            $table->foreign('id_perusahaan')->references('id')->on('u_perusahaan');
            $table->foreign('id_karyawan')->references('id')->on('h_karyawan');
            $table->foreign('id_supplier')->references('id')->on('p_supplier');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_p_po');
    }
}
