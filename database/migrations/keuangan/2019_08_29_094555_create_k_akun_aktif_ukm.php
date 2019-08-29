<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKAkunAktifUkm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('k_akun_aktif_ukm', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('id_sub_akun')->nullable();
			$table->integer('id_subsub_akun')->nullable();
			$table->string('kode_akun_aktif','15');
			$table->string('nm_akun_aktif','50');
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
        Schema::dropIfExists('k_akun_aktif_ukm');
    }
}
