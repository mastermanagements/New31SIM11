<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PKasirKasir extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_kerja_kasir', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tgl_mulai');
            $table->time('jam_mulai');
            $table->integer('id_shift_kasir');
            $table->decimal('total_pemasukan')->default(0);
            $table->decimal('total_pengeluaran')->default(0);
            $table->decimal('kas_disetor')->default(0);
            $table->integer('penerima')->unsigned();
            $table->enum('status_kerja',['0','1'])->comment('0=mulai, 1=selesai')->default(0);
            $table->time('jam_selesai');
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
        Schema::dropIfExists('p_kerja_kasir');
    }
}
