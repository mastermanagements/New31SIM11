<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIInvestorJualSaham extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_investor_jual_saham', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tgl_jual_s');
            $table->integer('id_periode_invest')->unsigned();
            $table->integer('id_investor_penjual')->unsigned();
            $table->decimal('lembar_saham_penjual',12,2);
            $table->decimal('jumlah_dijual',12,2);
            $table->integer('id_investor_pembeli')->unsigned();
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
        Schema::dropIfExists('i_investor_jual_saham');
    }
}
