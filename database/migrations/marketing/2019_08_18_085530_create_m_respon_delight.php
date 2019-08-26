<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMResponDelight extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_respon_delight', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('id_delight')->unsigned();
			$table->text('respon_klien');
			$table->integer('id_bagian')->nullable();
			$table->integer('id_divisi')->nullable();
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
        Schema::dropIfExists('m_respon_delight');
    }
}
