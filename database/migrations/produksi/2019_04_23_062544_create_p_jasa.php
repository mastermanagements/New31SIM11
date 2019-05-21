<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePJasa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_jasa', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_kategori_produk')->unsigned();
            $table->integer('id_subkategori_produk')->nullable();
            $table->integer('id_subsubkategori_produk')->nullable();
            $table->string('nm_jasa');
            $table->decimal('harga_jasa',12,2);
            $table->text('rincian_jasa');
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
        Schema::dropIfExists('p_jasa');
    }
}
