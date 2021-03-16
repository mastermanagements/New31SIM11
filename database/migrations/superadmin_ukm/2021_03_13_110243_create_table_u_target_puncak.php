<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUTargetPuncak extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('u_target_puncak', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('periode');
            $table->year('thn_mulai');
            $table->year('thn_selesai');
            $table->text('target_puncak');
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
        Schema::dropIfExists('u_target_puncak');
    }
}
