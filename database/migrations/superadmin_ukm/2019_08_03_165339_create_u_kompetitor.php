<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUKompetitor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('u_kompetitor', function (Blueprint $table) {
            $table->increments('id');
			$table->string('nm_kompetitor');
			$table->string('badan_hukum');
			$table->string('bidang_usaha');
			$table->text('alamat');
			$table->integer('id_prov');
			$table->integer('id_kab');
			$table->string('cp')->nullable();
			$table->string('telp')->nullable();
			$table->string('hp')->nullable();
			$table->string('wa')->nullable();
			$table->string('teleg')->nullable();
			$table->string('email')->nullable();
			$table->string('web')->nullable();
			$table->string('akun_fb')->nullable();
			$table->string('fanspages')->nullable();
			$table->string('twitter')->nullable();
			$table->string('ig')->nullable();
			$table->integer('id_perusahaan')->unsigned();
            $table->integer('id_karyawan')->unsigned();;
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
        Schema::dropIfExists('u_kompetitor');
    }
}
