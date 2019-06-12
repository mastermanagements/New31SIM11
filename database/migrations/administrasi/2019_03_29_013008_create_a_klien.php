<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAKlien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('a_klien', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nm_klien');
            $table->text('alamat');
            $table->string('pekerjaan');
            $table->string('hp');
            $table->string('wa')->nullable();
            $table->string('email')->nullable();
            $table->string('teleg')->nullable();
            $table->string('ig')->nullable();
            $table->string('fb')->nullable();
            $table->string('twiter')->nullable();
            $table->string('nm_perusahaan')->nullable();
            $table->string('alamat_perusahaan')->nullable();
            $table->string('telp_perusahaan')->nullable();
            $table->string('jabatan')->nullable();
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
        Schema::dropIfExists('a_klien');
    }
}
