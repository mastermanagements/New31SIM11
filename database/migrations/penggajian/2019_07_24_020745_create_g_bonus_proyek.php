<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGBonusProyek extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('G_bonus_proyek', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_tim_proyek')->unsigned();
            $table->integer('nilai_apt');
            $table->integer('id_kelas_proyek')->unsigned();
            $table->integer('besar_tunjangan');
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
        Schema::dropIfExists('G_bonus_proyek');
    }
}
