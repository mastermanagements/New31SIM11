<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUWewenangJobdesc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('u_wewenang_jobdesc', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('id_jobdesc')->unsigned();
          $table->string('item_wewenang');
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
        Schema::dropIfExists('u_wewenang_jobdesc');
    }
}
