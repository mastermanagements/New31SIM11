<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMResponConvert extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_respon_convert', function (Blueprint $table) {
             $table->increments('id');
			$table->integer('id_pel_m')->unsigned();
			$table->integer('jum_email')->default('0');
			$table->integer('jum_wa')->default('0');
			$table->integer('jum_teleg')->default('0');
			$table->integer('ket')->nullable();
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
        Schema::dropIfExists('m_respon_convert');
    }
}
