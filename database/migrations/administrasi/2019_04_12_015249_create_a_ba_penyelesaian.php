<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateABaPenyelesaian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('a_ba_penyelesaian', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_spk')->unsigned();
            $table->text('isi_bapeny');
            $table->string('file_bapeny')->nullable();
            $table->string('scan_file')->nullable();
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
        Schema::dropIfExists('a_ba_penyelesaian');
    }
}
