<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMEvaluasiMarketing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_evaluasi_marketing', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('id_kriteria_evaluasi')->unsigned();
			$table->enum('dimensi',['Realtime','Audience','Acquisition','Behavior','Conversions']);
            $table->integer('id_indikator_evaluasi')->unsigned();
            $table->string('jenis_content')->nullable();
            $table->string('link_url')->nullable();
			$table->integer('id_solusi_evaluasi')->unsigned();
			$table->text('ket')->nullable();
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
        Schema::dropIfExists('m_evaluasi_marketing');
    }
}
