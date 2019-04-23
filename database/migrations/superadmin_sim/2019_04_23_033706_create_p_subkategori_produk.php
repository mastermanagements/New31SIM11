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
        Schema::create('p_subkategori_produk', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_kategori_produk')->unsigned();
            $table->string('nm_subkategori_produk');
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
        Schema::dropIfExists('p_subkategori_produk');
    }
}
