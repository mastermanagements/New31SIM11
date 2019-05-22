<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUTargetTahunan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('u_target_tahunan', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('id_tjp')->unsigned();
			$table->year('tahun', 4);
			$table->integer('id_bagian_p')->unsigned();
			$table->integer('id_divisi_p')->unsigned();
			$table->integer('id_jabatan_p')->unsigned();
			$table->text('target_tahunan');
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
        Schema::dropIfExists('u_target_tahunan');
    }
}
