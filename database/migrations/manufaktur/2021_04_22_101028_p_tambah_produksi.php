<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PTambahProduksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_tambah_produksi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_barang')->unsigned();
            $table->string('kode_produksi')->nullable();
            $table->string('batch_number')->nullable();
            $table->string('no_serial')->nullable();
            $table->date('tgl_mulai')->nullable();
            $table->time('jam_mulai')->nullable();
            $table->integer('id_supervisor_produksi')->unsigned();
            $table->date('tgl_selesai')->nullable();
            $table->time('jam_selesai')->nullable();
            $table->date('tgl_mulai_qc')->nullable();
            $table->time('jam_mulai_qc')->nullable();
            $table->integer('brg_dalam_proses')->nullable();
            $table->integer('jumlah_bdp_bagus')->default(0)->nullable();
            $table->integer('jumlah_bdp_rusak')->default(0)->nullable();
            $table->enum('status_bdp',['0','1'])->default(0)->nullable();
            $table->date('expired_date_bdp')->nullable();
            $table->integer('jumlah_brg_jadi_bagus')->default(0)->nullable();
            $table->integer('jumlah_brg_jadi_rusan')->default(0)->nullable();
            $table->date('expired_date_bj')->nullable();
            $table->enum('status_produksi',['0','1','2'])->default(0)->nullable();
            $table->time('lama_produksi')->nullable();
            $table->integer('id_produksi')->unsigned();
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
        Schema::dropIfExists('p_tambah_produksi');
    }
}
