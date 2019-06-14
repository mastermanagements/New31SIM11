<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateASuratKeluar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('a_surat_keluar', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jenis_surat')->unsigned();
			$table->string('no_surat_keluar');
			$table->string('hal');
			$table->string('ditujukan');
            $table->text('isi_surat');
            $table->enum('status_surat',['0','1'])->default(0);
			$table->date('tgl_dikirim')->nullable();
            $table->string('scan_file')->nullable();
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
        Schema::dropIfExists('a_surat_keluar');
    }
}
