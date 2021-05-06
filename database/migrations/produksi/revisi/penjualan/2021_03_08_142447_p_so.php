<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PSo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_so', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_tawar_beli')->default(0)->nullable();
            $table->date('tgl_so');
            $table->string('no_so');
            $table->string('no_po')->nullable();
            $table->integer('id_klien')->unsigned();
            $table->date('tgl_dikirim')->nullable();
            $table->integer('diskon_tambahan')->nullable()>default(0);
            $table->integer('pajak')->nullable()>default(0);
            $table->decimal('dp_so',12,2)->default(0);
            $table->decimal('kurang_bayar',12,2)->default(0);
            $table->text('ket')->nullable();
            $table->enum('status',['0','1'])->default(0)->comment('0=open, 1=close');
            $table->integer('id_perusahaan')->unsigned();
            $table->integer('id_karyawan')->unsigned();
            
            $table->foreign('id_perusahaan')->references('id')->on('u_perusahaan');
            $table->foreign('id_karyawan')->references('id')->on('h_karyawan');
            $table->foreign('id_klien')->references('id')->on('a_klien');
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
        Schema::dropIfExists('p_so');
    }
}
