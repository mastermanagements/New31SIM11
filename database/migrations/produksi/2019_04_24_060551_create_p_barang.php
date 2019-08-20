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
            $table->increments('id');
            $table->integer('id_kategori_produk')->unsigned();
            $table->integer('id_subkategori_produk')->default(0);
            $table->integer('id_subsubkategori_produk')->default(0);
            $table->string('nm_barang');
            $table->text('spec_barang');
            $table->text('desc_barang');
            $table->date('expired_date');
            $table->integer('stok_barang');
            $table->integer('diskon');
            $table->decimal('harga_jual',12, 2);
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
        Schema::dropIfExists('p_barang');
    }
}
