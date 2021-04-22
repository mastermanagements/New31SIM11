<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PJumlahKas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_jumlah_kas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_kerja_kasir')->unsigned();
            $table->integer('id_akun_aktif')->unsigned();
            $table->decimal('jumlah_aktir',12,2)->default(0);
            $table->integer('id_perusahaan')->unsigned();
            $table->integer('id_karyawan')->default(0);
            $table->foreign('id_perusahaan')->references('id')->on('u_perusahaan')->onDelete('cascade');
            $table->foreign('id_kerja_kasir')->references('id')->on('p_kerja_kasir')->onDelete('cascade');
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
        Schema::dropIfExists('p_jumlah_kas');
    }
}
