<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGTunjanganGaji extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('g_tunjangan_gaji', function (Blueprint $table) {
            $table->increments('id');
            $table->date('periode');
            $table->integer('id_ky')->unsigned();
            $table->string('nm_tunjangan');
            $table->integer('besar_tunjangan');
            $table->enum('status_tunjangan', [0,1])->default(0);
            $table->enum('status_aktif', [0,1])->default(0);
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
        Schema::dropIfExists('g_tunjangan_gaji');
    }
}
