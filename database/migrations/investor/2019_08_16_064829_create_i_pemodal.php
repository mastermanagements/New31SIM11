<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIPemodal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_pemodal', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tgl_invest');
            $table->integer('id_periode_invest')->unsigned();
            $table->integer('id_investor')->unsigned();
            $table->integer('id_bentuk_invest')->unsigned();
            $table->decimal('persen_saham', 12, 2);
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
        Schema::dropIfExists('i_pemodal');
    }
}
