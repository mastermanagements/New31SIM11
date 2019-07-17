<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMContentSegmenting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_content_segmenting', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('id_subsub_segmenting')->nullable()->default('0');
			$table->string('content_segmenting');
			$table->enum('jenis_marketing',['0','1']);
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
        Schema::dropIfExists('m_content_segmenting');
    }
}
