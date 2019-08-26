<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMStatusClosing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_status_closing', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('id_closing')->unsigned();
			$table->enum('tool_closing',['Email','Telp','WA','Messengger','Telegram','Meet up']);
			$table->text('content_closing');
			$table->text('respon_klien')->nullable();
			$table->enum('hasil_akhir',['Deal','No deal','Follow Up','No Respond']);
			$table->integer('id_bagian')->nullable();
			$table->integer('id_divisi')->nullable();
			$table->enum('status_closing',['Open','Close']);
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
        Schema::dropIfExists('m_status_closing');
    }
}
