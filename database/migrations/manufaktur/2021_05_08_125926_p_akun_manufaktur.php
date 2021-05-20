<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PAkunManufaktur extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_akun_manufaktur', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('jenis_jurnal',['0','1','2'])->comment('0= Pemakaian bahan baku, 1=penambahan persediaan barang jadi, 2=penambahan persediaan barang dalam proses');
            $table->integer('id_ket_transaksi')->unsigned();
            $table->enum('jenis_transaksi',['0','1'])->comment('0=Penerimaan, 1=Pengeluaran');
            $table->enum('posisi_akun',['0','1'])->comment('0=debet, 1=kredit');
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
        Schema::dropIfExists('p_akun_manufaktur');
    }
}
