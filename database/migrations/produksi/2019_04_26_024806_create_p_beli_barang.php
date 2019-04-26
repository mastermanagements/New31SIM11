<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePBeliBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_beli_barang', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tgl_beli');
            $table->integer('id_barang')->unsigned();
            $table->integer('id_suplier')->unsigned();
            $table->integer('jumlah_barang')->unsigned();
            $table->decimal('harga_beli')->unsigned();
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
        Schema::dropIfExists('p_beli_barang');
    }
}
