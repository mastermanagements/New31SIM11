<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMJawabanTargeting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_jawaban_targeting', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('id_targeting')->unsigned();
			$table->integer('id_pertanyaan_targeting')->unsigned();
			$table->enum('jawaban_kriteria',['0','1']);
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
        Schema::dropIfExists('m_jawaban_targeting');
    }
}
