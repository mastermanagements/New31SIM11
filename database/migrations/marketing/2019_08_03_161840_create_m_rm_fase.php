<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMRmFase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_rm_fase', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('id_rm')->unsigned();
			$table->date('tgl_rencana_terbit');
			$table->string('fase_marketing');
			$table->integer('id_barang')->nullable();
			$table->integer('id_jasa')->nullable();
			//$table->string('sasaran_klien');
			$table->integer('id_media_marketing')->unsigned();
			$table->integer('id_submedia_marketing')->nullable();
			$table->integer('id_content_marketing')->nullable();
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
        Schema::dropIfExists('m_rm_fase');
    }
}
