<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHWawancara extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h_wawancara', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_lamaran_p')->unsigned();
            $table->date('tgl_wawancara');
            $table->integer('id_item_wawancara')->unsigned();
            $table->integer('nilai_akhir')->unsigned();
            $table->text('ket');
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
        Schema::dropIfExists('h_wawancara');
    }
}
