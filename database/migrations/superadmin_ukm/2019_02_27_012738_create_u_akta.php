<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUAkta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('u_akta', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_akta');
            $table->date('tgl_akta');
            $table->string('notaris');
            $table->string('bentuk_usaha');
            $table->string('no_rak')->nullable();
            $table->string('file_akta');
            $table->integer('id_perusahaan')->unsigned();
            $table->integer('id_user_ukm')->unsigned();
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
        Schema::dropIfExists('u_akta');
    }
}
