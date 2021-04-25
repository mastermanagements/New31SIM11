<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PComplainBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_complain_barang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_sales')->unsigned();
            $table->integer('id_detail_sales')->unsigned();
            $table->integer('id_barang')->unsigned();
            $table->decimal('hpp',12,2)->default(0);
            $table->integer('jumlah_beli')->default(0);
            $table->integer('diskon_item')->default(0);
            $table->integer('complain_jumlah')->default(0);
            $table->string('complain_kualitas')->nullable();
            $table->string('ket')->nullable();
            $table->enum('status_complain',['0','1'])->default(0);
            $table->text('alasan_ditolah')->nullable();
            $table->enum('konfirm_klien',['0','1'])->default(0);
            $table->integer('id_perusahaan')->unsigned();
            $table->integer('id_karyawan')->unsigned();

            $table->foreign('id_perusahaan')->references('id')->on('u_perusahaan');
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
        Schema::dropIfExists('p_complain_barang');
    }
}
