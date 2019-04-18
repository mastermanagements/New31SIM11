<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateABaSerops extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('a_ba_serops', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_spk')->unsigned();
            $table->text('isi_serops');
            $table->string('file_serops')->nullable();
            $table->string('scan_file')->nullable();
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
        Schema::dropIfExists('a_ba_serops');
    }
}
