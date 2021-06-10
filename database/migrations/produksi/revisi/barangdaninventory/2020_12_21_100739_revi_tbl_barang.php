<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReviTblBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_barang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_kategori_produk')->unsigned()->default(0);
            $table->integer('id_subkategori_produk')->unsigned()->default(0);
            $table->integer('id_subsubkategori_produk')->unsigned()->default(0);
            $table->enum('jenis_barang',['0','1','2'])->comment('0=barang jadi, 1=barang barang mentah, 2=barang dalam proses')->default('0');
            $table->string('kd_barang',20)->nullable();
            $table->string('barcode')->nullable();
            $table->string('nm_barang');
            $table->integer('id_satuan')->unsigned();
            $table->string('spec_barang')->nullable();
            $table->string('merk_barang',50)->nullable();
            $table->text('desc_barang')->nullable();
            $table->string('no_rak',50)->nullable();
            $table->integer('stok_minimum')->default('0');
            $table->integer('stok_akhir')->default('0');
            $table->decimal('hpp',12, 2);
            $table->enum('metode_jual',['0','1'])->default('0')->comment('0=berdasarkan satu harga, 1 = berdasarkan jumlah beli');
            $table->string('gambar')->nullable();
            $table->integer('id_perusahaan')->unsigned();
            $table->integer('id_karyawan')->unsigned();

            $table->foreign('id_kategori_produk')->references('id')->on('p_kategori_produk');
            $table->foreign('id_subkategori_produk')->references('id')->on('p_subkategori_produk');
            $table->foreign('id_subsubkategori_produk')->references('id')->on('p_subsubkategori_produk');
            $table->foreign('id_satuan')->references('id')->on('p_satuan');
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
        Schema::dropIfExists('p_barang');
    }
}
