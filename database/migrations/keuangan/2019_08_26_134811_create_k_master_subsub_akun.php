<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKMasterSubsubAkun extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('k_master_subsub_akun', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('id_m_sub_akun');
			$table->string('kode_m_subsub_akun',15);
			$table->string('nm_m_subsub_akun',50);
			$table->enum('off_on',['0','1'])->comment('0=akun non aktif, 1=akun aktif');
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
        Schema::dropIfExists('k_master_subsub_akun');
    }
}