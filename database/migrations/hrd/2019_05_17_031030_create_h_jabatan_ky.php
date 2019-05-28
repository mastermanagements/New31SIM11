<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHJabatanKy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h_jabatan_ky', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('id_ky')->unsigned();
			$table->integer('id_jabatan_p')->unsigned();
			$table->date('mulai_menjabat');
			$table->date('selesai_menjabat');
			$table->enum('status_jabatan',['aktif','non aktif']);
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
        Schema::dropIfExists('h_jabatan_ky');
    }
}
