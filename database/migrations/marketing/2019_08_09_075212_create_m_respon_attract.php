<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMResponAttract extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_respon_attract', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('id_pel_m')->unsigned();
			$table->integer('jum_like')->default('0');
			$table->integer('jum_comment')->default('0');
			$table->integer('jum_share')->default('0');
			$table->integer('jum_follower')->default('0');
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
        Schema::dropIfExists('m_respon_attract');
    }
}
