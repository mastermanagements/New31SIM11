<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJualSahamPerusahaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_jual_saham_perusahaan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_periode_invest')->unsigned();
            $table->decimal('jumlah_persen_saham',12,2);
            $table->decimal('jumlah_saham_terbit',12,2);
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
        Schema::dropIfExists('i_jual_saham_perusahaan');
    }
}
