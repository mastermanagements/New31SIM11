<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMHasilSegmenting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_hasil_segmenting', function (Blueprint $table) {
            $table->increments('id');
			$table->year('tahun',4);
			$table->integer('id_barang')->nullable();
			$table->integer('id_jasa')->nullable();
			$table->integer('id_content_segmenting')->unsigned();
			$table->string('hasil_segmenting');
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
        Schema::dropIfExists('m_hasil_segmenting');
    }
}
