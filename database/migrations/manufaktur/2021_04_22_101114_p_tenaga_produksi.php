<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PTenagaProduksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_tenaga_produksi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_tambah_produksi');
            $table->integer('tenaga_kerja');
            $table->enum('pilihan_upah',['0','1'])->default(0);
            $table->decimal('jumlah_upah')->default(0);
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
        Schema::dropIfExists('p_tenaga_produksi');
    }
}
