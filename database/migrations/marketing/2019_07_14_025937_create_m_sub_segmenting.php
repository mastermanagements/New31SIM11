<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMSubSegmenting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_sub_segmenting', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('id_segmenting')->unsigned();
			$table->string('item_sub_segmenting')->nullable();
			//$table->enum('jenis_marketing',['0','1']);
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
        Schema::dropIfExists('m_sub_segmenting');
    }
}
