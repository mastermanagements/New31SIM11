<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_so')->default(0);
            $table->date('tgl_sales');
            $table->string('no_sales',50);
            $table->integer('id_klien')->unsigned();
            $table->date('tgl_kirim')->nullable();
            $table->integer('diskon_tambahan')->default(0);
            $table->integer('pajak')->default(0);
            $table->decimal('dp_so')->nullable()->default(0);
            $table->decimal('bayar')->default(0);
            $table->decimal('kurang_bayar')->nullable()->default(0);
            $table->enum('metode_bayar', ['0','1'])->default(0)->comment('0=Tunai, 1=Kredit');
            $table->date('tgl_jatuh_tempo')->nullable();
            $table->decimal('ongkir')->default(0)->nullable();
            $table->decimal('total')->default(0);
            $table->text('keterangan')->nullable();
            $table->enum('status_bayar', ['0','1'])->default(0)->comment('0=lunas,1 = belum lunas');
            $table->integer('id_komisi_sales')->nullable()->default(0);
            $table->integer('id_perusahaan')->unsigned();
            $table->integer('id_karyawan')->unsigned();

            //$table->foreign('id_so')->references('id')->on('p_so');
            $table->foreign('id_klien')->references('id')->on('a_klien');
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
        Schema::dropIfExists('p_sales');
    }
}
