<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHPotonganAbsen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h_potongan_absen', function (Blueprint $table) {
            $table->increments('id');
            $table->date('periode');
            $table->integer('id_absensi');
            $table->integer('id_potongan_tetap');
            $table->integer('jumlah_item_p');
            $table->integer('id_perusahaan');
            $table->integer('id_karyawan');
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
        Schema::dropIfExists('h_potongan_absen');
    }
}
