<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMPertanyaanTargeting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_pertanyaan_targeting', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('id_kriteria_targeting')->unsigned();
			$table->string('pertanyaan_kriteria');
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
        Schema::dropIfExists('m_pertanyaan_targeting');
    }
}
