<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateISahamReal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_saham_real', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_periode_saham')->unsigned();
            $table->decimal('jum_saham',12,2);
            $table->string('satuan');
            $table->enum('status',['aktif','non aktif'])->default('non aktif');
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
        Schema::dropIfExists('i_saham_real');
    }
}
