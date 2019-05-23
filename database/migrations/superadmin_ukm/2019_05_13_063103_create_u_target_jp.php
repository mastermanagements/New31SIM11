<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUTargetJp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('u_target_jp', function (Blueprint $table) {
            $table->increments('id');
			$table->string('nm_tjp');
			$table->integer('periode');
			$table->year('thn_mulai', 4);
			$table->year('thn_selesai', 4);
			$table->text('isi_tjp');
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
        Schema::dropIfExists('u_target_jp');
    }
}
