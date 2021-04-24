<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PBahanProduksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_bahan_produksi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_tambah_produksi')->unsigned();
            $table->integer('id_barang_mentah')->unsigned();
            $table->decimal('jumlah_bahan',12,2)->default(0);
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
        Schema::dropIfExists('p_bahan_produksi');
    }
}
