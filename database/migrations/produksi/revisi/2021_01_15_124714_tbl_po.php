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
        Schema::create('tbl_p_po', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_tawar_beli')->nullable();
            $table->date('tgl_po');
            $table->string('no_po');
            $table->integer('id_supplier');
            $table->date('tgl_krm');
            $table->integer('diskon_tambahan')->nullable();
            $table->integer('pajak')->nullable();
            $table->decimal('dp_po');
            $table->decimal('kurang_bayar',12,2);
            $table->text('ket');
            $table->enum('status_po',['0','1'])->default(0)->comment('0=open, 1=close');
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
        Schema::dropIfExists('tbl_p_po');
    }
}
