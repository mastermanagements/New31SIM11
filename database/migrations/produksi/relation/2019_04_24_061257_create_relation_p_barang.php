<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationPBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('p_barang', function (Blueprint $table) {

            $table->foreign('id_kategori_produk')->references('id')->on('p_kategori_produk');

			
            $table->foreign('id_kategori_produk')->references('id')->on('p_kategori_produk');
            $table->foreign('id_subkategori_produk')->references('id')->on('p_subkategori_produk');
            $table->foreign('id_subsubkategori_produk')->references('id')->on('p_subsubkategori_produk');
            $table->foreign('id_perusahaan')->references('id')->on('u_perusahaan');
            $table->foreign('id_karyawan')->references('id')->on('h_karyawan');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('p_barang', function (Blueprint $table) {
            //
        });
    }
}
