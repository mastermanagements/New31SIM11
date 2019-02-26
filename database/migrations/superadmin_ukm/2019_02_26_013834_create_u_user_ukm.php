<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUUserUkm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('u_user_ukm', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('email',100)->unique();
            $table->string('password');
            $table->string('telp')->nullable();
            $table->string('hp');
            $table->string('wa');
            $table->string('telegram')->nullable();
            $table->integer('provinsi_id')->unsigned();
            $table->integer('kab_id')->unsigned();
            $table->enum('status_verifikasi',['0','1'])->default('0');
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
        Schema::dropIfExists('u_user_ukm');
    }
}
