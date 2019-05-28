<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHJenisPsikotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h_jenis_psikotes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('jenis_psikotes');
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
        Schema::dropIfExists('h_jenis_psikotes');
    }
}
