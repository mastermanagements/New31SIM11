<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationPBeliBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('p_beli_barang', function (Blueprint $table) {
            //
            $table->foreign('id_barang')->references('id')->on('p_barang');
            $table->foreign('id_suplier')->references('id')->on('p_supplier');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('p_beli_barang', function (Blueprint $table) {
            //
        });
    }
}
