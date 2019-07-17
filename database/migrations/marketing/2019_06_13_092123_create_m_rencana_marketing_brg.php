<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMRencanaMarketingBrg extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_rencana_marketing_brg', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('id_rencana_pend_brg')->unsigned();
			$table->integer('jum_klien_lama');
			$table->integer('jum_klien_baru');
			$table->text('ket');
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
        Schema::dropIfExists('m_rencana_marketing_brg');
    }
}
