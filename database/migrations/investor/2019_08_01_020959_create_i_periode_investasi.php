<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIPeriodeInvestasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_periode_investasi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('periode_ke');
            $table->string('nm_periode');
            $table->integer('vesting_periode');
            $table->decimal('nilai_valuasi',12,2);
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
        Schema::dropIfExists('i_periode_investasi');
    }
}
