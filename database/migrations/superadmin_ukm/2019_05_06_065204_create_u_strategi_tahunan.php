<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUStrategiTahunan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('u_strategi_tahunan', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('id_sjp')->unsigned();
			$table->integer('id_target_tahunan')->unsigned();
            $table->text('isi_stahunan');
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
        Schema::dropIfExists('u_strategi_tahunan');
    }
}
