<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKRencanaPendBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('k_rencana_pend_barang', function (Blueprint $table) {
            $table->increments('id');
			$table->year('tahun', 4);
			$table->string('bulan',50);
			$table->integer('id_barang')->unsigned();
			$table->integer('target_brg_terjual');
			$table->integer('target_klien_beli');
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
        Schema::dropIfExists('k_rencana_pend_barang');
    }
}
