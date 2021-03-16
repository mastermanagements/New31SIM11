<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUTargetEksekutif extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('u_target_eksekutif', function (Blueprint $table) {
            $table->increments('id');
            $table->year('tahun');
            $table->integer('id_bagian_p')->unsigned();;
            $table->integer('id_jabatan_p')->unsigned();;
            $table->string('target_eksekutif');
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
        Schema::dropIfExists('u_target_eksekutif');
    }
}
