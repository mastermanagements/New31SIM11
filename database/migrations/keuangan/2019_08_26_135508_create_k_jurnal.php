<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKJurnal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('k_jurnal', function (Blueprint $table) {
            $table->increments('id');
			$table->enum('jenis_jurnal',['0','1','2'])->comment('0 = Saldo Awal, 1= Jurnal Umum, 2= Jurnal Penyesuaian');
            $table->date('tgl_jurnal');
			$table->integer('id_transaksi')->unsigned();
			$table->string('no_transaksi',5);
			$table->text('ket')->nullable();
			$table->integer('debet_kredit')->comment('0=debet, 1=kredit');
			$table->bigInteger('jumlah_transaksi');
			$table->string('bukti_transaksi')->nullable();
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
        Schema::dropIfExists('k_jurnal');
    }
}
