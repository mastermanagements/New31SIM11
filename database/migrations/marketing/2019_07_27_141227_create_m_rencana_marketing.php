<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMRencanaMarketing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_rencana_marketing', function (Blueprint $table) {
            $table->increments('id');
			$table->year('tahun',4);
			$table->string('bulan',50);
			$table->enum('off_on',['0','1'])->comment('0=marketing off line', '1=marketing online')->nullable();
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
        Schema::dropIfExists('m_rencana_marketing');
    }
}
