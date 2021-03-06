<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKAkunUkm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('k_akun_ukm', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('id_m_akun')->unsigned();
			$table->string('kode_akun',15);
			$table->string('nm_akun');
			$table->enum('posisi_saldo',['D','K'])->comment('D=Debet, K=Kredit')->default('D');
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
        Schema::dropIfExists('k_akun_ukm');
    }
}
