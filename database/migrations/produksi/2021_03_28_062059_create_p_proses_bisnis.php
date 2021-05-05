<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePProsesBisnis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_proses_bisnis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_barang')->unsigned()->nullable();
            $table->string('proses_bisnis');
            $table->text('ket')->nullable();
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
        Schema::dropIfExists('p_proses_bisnis');
    }
}
