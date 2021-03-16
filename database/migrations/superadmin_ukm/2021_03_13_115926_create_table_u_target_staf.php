<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUTargetStaf extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('u_target_staf', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_target_superv')->unsigned();;
            $table->string('bulan', 50);
            $table->integer('nm_karyawan')->unsigned();;
            $table->string('target_staf');
            $table->integer('jumlah_target');
            $table->string('satuan_target',40);
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
        Schema::dropIfExists('u_target_staf');
    }
}
