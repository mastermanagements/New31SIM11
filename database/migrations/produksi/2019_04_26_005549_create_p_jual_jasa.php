<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePJualJasa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_jual_jasa', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_jasa')->unsigned();
            $table->integer('id_klien')->unsigned();
            $table->text('detail_pesanan');
            $table->decimal('harga_jual');
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
        Schema::dropIfExists('p_jual_jasa');
    }
}
