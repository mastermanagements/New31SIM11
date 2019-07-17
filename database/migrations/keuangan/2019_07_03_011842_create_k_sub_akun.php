<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKSubAkun extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('k_sub_akun', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('id_akun')->unsigned();
			$table->string('kode_sub_akun','8');
			$table->string('nm_sub_akun');
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
        Schema::dropIfExists('k_sub_akun');
    }
}
