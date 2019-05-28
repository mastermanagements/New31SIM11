<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUStrategiBulanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('u_strategi_bulanan', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('id_stahunan')->unsigned();
			$table->integer('id_target_bulanan')->unsigned();
            $table->text('isi_sbulanan');
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
        Schema::dropIfExists('u_strategi_bulanan');
    }
}
