<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePSubkategoriProduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('p_subkategori_produk', function (Blueprint $table) {
            //
            $table->foreign('id_kategori_produk')->references('id')->on('p_kategori_produk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('p_subkategori_produk', function (Blueprint $table) {
            //
        });
    }
}
