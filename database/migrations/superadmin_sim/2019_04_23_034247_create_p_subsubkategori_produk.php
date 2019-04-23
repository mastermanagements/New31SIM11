<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePSubsubkategoriProduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_subsubkategori_produk', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_subkategori_produk')->unsigned();
            $table->string('nm_subsub_kategori_produk');
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
        Schema::dropIfExists('p_subsubkategori_produk');
    }
}
