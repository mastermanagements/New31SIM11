<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUPerusahaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('u_perusahaan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nm_usaha');
            $table->string('singkatan_usaha', 50)->nullable();
            $table->text('alamat');
            $table->integer('id_prov')->unsigned();
            $table->integer('id_kab')->unsigned();
            $table->string('kode_pos', 10)->nullable();
            $table->string('telp', 12)->nullable();
            $table->string('hp', 15)->nullable();
            $table->string('wa', 15)->nullable();
            $table->string('teleg', 50)->nullable();
            $table->string('fp', 100)->nullable();
            $table->string('ig', 50)->nullable();
            $table->string('twitter', 50)->nullable();
            $table->string('tiktok', 50)->nullable();
            $table->string('email', 60);
            $table->enum('jenis_kantor', ['0', '1']);
            $table->enum('badan_usaha', ['0', '1', '2', '3', '5', '6']);
            $table->enum('jenis_usaha', ['0', '1', '2', '3']);
            $table->string('bidang_usaha', 200);
            $table->string('spesifik_usaha', 200);
            $table->enum('jenis_jasa', ['0', '1']);
            $table->string('web', 100)->nullable();
            $table->string('logo')->nullable();
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
        Schema::dropIfExists('u_perusahaan');

    }
}
