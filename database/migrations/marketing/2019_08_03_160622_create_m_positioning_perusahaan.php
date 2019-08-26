<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMPositioningPerusahaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_positioning_perusahaan', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('id_kompetitor')->unsigned();
			$table->integer('id_barang')->nullable();
			$table->integer('id_jasa')->nullable();
			$table->text('plus_produk_k');
			$table->text('value_produk_k');
			$table->text('minus_produk_k');
            $table->integer('posisi_k')->unsigned();
			$table->text('plus_produk_p');
			$table->text('value_produk_p');
			$table->text('minus_produk_p');
            $table->integer('posisi_p')->unsigned();
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
        Schema::dropIfExists('m_positioning_perusahaan');
    }
}
