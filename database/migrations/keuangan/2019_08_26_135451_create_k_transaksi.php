<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('k_transaksi', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('id_ket_transaksi');
			$table->enum('jenis_transaksi',['0','1'])->comment('0 = Penerimaan, 1: Pengeluaran');
			$table->integer('id_akun_aktif')->unsigned();
			$table->enum('posisi_akun',['0','1'])->comment('0 = Debet, 1: Kredit');
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
        Schema::dropIfExists('k_transaksi');
    }
}
