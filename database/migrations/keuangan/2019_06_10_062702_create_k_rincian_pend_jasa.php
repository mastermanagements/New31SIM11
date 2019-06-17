<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKRincianPendJasa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('k_rincian_pend_jasa', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('id_rencana_pend_jasa')->unsigned();
			$table->integer('id_jasa')->unsigned();
			$table->integer('target_jasa_terjual');
			$table->integer('target_klien_beli');
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
        Schema::dropIfExists('k_rincian_pend_jasa');
    }
}
