<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PProsesProduksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_proses_produksi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_tambah_produksi');
            $table->integer('id_proses_bisnis');
            $table->date('tgl_mulai')->default(now());
            $table->time('jam_mulai')->default(now());
            $table->text('ket')->nullable();
            $table->date('tgl_selesai')->default(now());
            $table->time('jam_selesai')->default(now());
            $table->integer('id_perusahaan')->unsigned();
            $table->integer('id_karyawan')->unsigned();
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
        Schema::dropIfExists('p_proses_produksi');
    }
}
