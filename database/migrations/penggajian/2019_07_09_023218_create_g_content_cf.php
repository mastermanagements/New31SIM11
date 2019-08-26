<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGContentCf extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('g_content_cf', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_sub_cf')->unsigned();
            $table->integer('id_pokok')->unsigned();
            $table->text('kolom_content');
            $table->text('content_cf');
            $table->text('bobot_content_cf');
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
        Schema::dropIfExists('g_content_cf');
    }
}
