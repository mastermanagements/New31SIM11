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
        Schema::table('p_barang', function (Blueprint $table) {
            //
            $table->decimal('stok_akhir',12,2);
            $table->enum('metode_jual',['0','1'])->default('0')->comment('0=berdasarkan satu harga, 1 = berdasarkan jumlah beli');
            $table->string('gambar');
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
