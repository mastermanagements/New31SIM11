<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrifingRapat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('a_rapat', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_ub')->unsigned();
            $table->date('tgl_rapat');
            $table->enum('pilihan_rapat',['Masukan','Solusi','Kesimpulan']);
            $table->text('keterangan');
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
        Schema::dropIfExists('a_rapat');
    }
}
