<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PCekBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_cek_barang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_order')->unsigned();
            // $table->integer('id_barang')->unsigned();
            // $table->integer('hpp');
            // $table->integer('jumlah_beli');
            // $table->integer('diskon_item')->nullable();
            // $table->decimal('jumlah_harga',12,2);
            // $table->enum('cek_jumlah', ['0','1']);
            // $table->enum('cek_kualitas', ['0','1']);
            // $table->text('ket');
            // $table->date('tgl_konfirm_cek');
            // $table->enum('status_return',['0','1']);
            // $table->text('alasan_ditolak');
            // $table->date('tgl_status_return');
            $table->date('tgl_tiba');
            $table->date('tgl_konfirm_cek');
            $table->date('tgl_status_return');
            $table->integer('id_perusahaan')->unsigned();
            $table->foreign('id_perusahaan')->references('id')->on('u_perusahaan')->onDelete('cascade');
            $table->foreign('id_order')->references('id')->on('p_order')->onDelete('cascade');
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
        Schema::dropIfExists('p_cek_barang');
    }
}
