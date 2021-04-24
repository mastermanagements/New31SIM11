<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_barang', function (Blueprint $table) {
            /*$table->increments('id');
            $table->integer('id_kategori_produk')->unsigned();
            $table->integer('id_subkategori_produk')->default(0);
            $table->integer('id_subsubkategori_produk')->default(0);
            $table->enum('jenis_barang',['0','1','2'])->comment('0=barang jadi, 1=barang barang mentah, 2=barang dalam proses')->default('0');
            $table->varchar('kd_barang',20)->nullable();
            $table->varchar('barcode')->nullable();
            $table->string('nm_barang');
            $table->integer('id_satuan')->unsigned();
            $table->text('spec_barang')->nullable();
            $table->varchar('merk_barang',50)->nullable();
            $table->text('desc_barang');
            $table->varchar('no_rak',10)->nullable();
            $table->integer('stok_minimum')->default('0');
            $table->integer('stok_akhir')->default('0');
            $table->decimal('hpp',12, 2);
            $table->enum('metode_jual',['0','1'])->default('0')->comment('0=berdasarkan satu harga, 1 = berdasarkan jumlah beli');
            $table->string('gambar')->nullable();
            $table->integer('id_perusahaan')->unsigned();
            $table->integer('id_karyawan')->unsigned();
            $table->timestamps();*/
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
