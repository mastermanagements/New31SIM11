<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PBiayaOverhead extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_biaya_overhead', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_tambah_produksi')->unsigned();
            $table->integer('id_item_overhead');
            $table->decimal('jumlah_biaya')->default(0);
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
        Schema::dropIfExists('p_biaya_overhead');
    }
}
