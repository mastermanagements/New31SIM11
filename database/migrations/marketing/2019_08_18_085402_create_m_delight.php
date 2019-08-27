<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMDelight extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_delight', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('id_klien')->unsigned();
			$table->enum('tool_delight',['Email','Telp','WA','Messengger','Telegram','Meet up']);
			$table->text('content_delight');
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
        Schema::dropIfExists('m_delight');
    }
}
