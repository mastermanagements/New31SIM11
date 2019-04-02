<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAProposal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('a_proposal', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_jenis_prop')->unsigned();
            $table->string('judul_prop');
            $table->date('tgl_prop');
            $table->string('ditujukan');
            $table->string('file_prop');
            $table->string('cover_prop');
            $table->enum('status_prop',['0','1'])->default(0);
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
        Schema::dropIfExists('a_proposal');
    }
}
