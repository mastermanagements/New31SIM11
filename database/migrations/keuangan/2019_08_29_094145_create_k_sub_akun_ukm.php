<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKSubAkunUkm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('k_sub_akun_ukm', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('id_akun')->unsigned();
			$table->string('kode_sub_akun',1);
			$table->string('nm_sub_akun');
			$table->enum('off_on',['0','1'])->comment('0=akun non aktif, 1=akun aktif');
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
        Schema::dropIfExists('k_sub_akun_ukm');
    }
}
