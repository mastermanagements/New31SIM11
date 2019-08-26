<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGDaftarGaji extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('g_daftar_gaji', function (Blueprint $table) {
            $table->increments('id');
            $table->year('priode');
            $table->integer('id_ky')->unsigned();
            $table->integer('besar_gaji');
            $table->text('ket');
            $table->enum('status_aktif',[0,1])->default(0);
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
        Schema::dropIfExists('g_daftar_gaji');
    }
}
