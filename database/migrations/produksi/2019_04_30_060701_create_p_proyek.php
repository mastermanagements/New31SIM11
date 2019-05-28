<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePProyek extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_proyek', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('jenis_proyek', [0,1]);
            $table->integer('id_spk')->unsigned();
            $table->integer('jangka_waktu');
            $table->text('rincian_proyek');
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
        Schema::dropIfExists('p_proyek');
    }
}
