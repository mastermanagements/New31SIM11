<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblPItemMasukKeluar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_item_masuk_keluar', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('jenis_item',['0','1'])->default(0)->comment('0: item masuk, 1:item keluar');
            $table->date('tgl');
            $table->integer('id_barang')->unsigned();
            $table->text('ket');
            $table->decimal('jumlah_brg');
            $table->integer('id_perusahaan')->unsigned();
            $table->timestamps();
            $table->foreign('id_barang')->references('id')->on('p_barang')->onDelete('cascade');
            $table->foreign('id_perusahaan')->references('id')->on('u_perusahaan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('p_item_masuk_keluar');
    }
}
