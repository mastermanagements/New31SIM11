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
            $table->integer('id_so')->unsigned()->default(0);
            $table->date('tgl_sales');
            $table->string('no_sales');
            $table->integer('id_klien')->unsigned();
            $table->date('tgl_kirim');
            $table->integer('diskon_tambahan')->default(0);
            $table->integer('pajak')->default(0);
            $table->decimal('dp_so')->default(0);
            $table->decimal('bayar')->default(0);
            $table->decimal('kurang_bayar')->default(0);
            $table->date('tgl_jatuh_tempo');
            $table->decimal('ongkir')->default(0);
            $table->text('keterangan')->nullable();
            $table->enum('status_bayar', ['0','1'])->default(1);
            $table->integer('id_komisi_sales')->default(0);
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
        Schema::dropIfExists('p_sales');
    }
}
