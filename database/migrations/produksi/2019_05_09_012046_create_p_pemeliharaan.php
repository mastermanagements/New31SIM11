<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePPemeliharaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_pemeliharaan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_jasa')->unsigned();
            $table->integer('id_jenis_pem')->unsigned();
            $table->string('nm_pemeliharaan');
            $table->integer('jangka_waktu');
            $table->decimal('biaya_pem', 12,2);
            $table->text('ket');
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
        Schema::dropIfExists('p_pemeliharaan');
    }
}
