<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PAkunPenjualan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_akun_penjualan', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('jenis_jurnal',['0','1','2','3','4','5','6','7','8','9','10','11','12'])->comment('')->default('0');
            $table->integer('id_ket_transaksi');
            $table->enum('jenis_transaksi',['0','1']);
            $table->integer('id_akun_aktif');
            $table->enum('posisi_akun',['-','0','1'])->default('-');
            $table->integer('id_perusahaan')->unsigned();
            $table->integer('id_karyawan')->default(0);
            $table->foreign('id_perusahaan')->references('id')->on('u_perusahaan')->onDelete('cascade');
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
        Schema::dropIfExists('p_akun_penjualan');
    }
}
