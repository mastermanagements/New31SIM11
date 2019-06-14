<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHRequestCuti extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h_request_cuti', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tgl_req');
            $table->enum('jenis_izin', [0,1,2])->comment("0=Cuti, 1=izin, 2=sakit");
            $table->integer('id_cuti')->nullable();
            $table->integer('lama_request');
            $table->enum('upprove',[0,2])->comment("0=masih diproses, 1=tidak disetujui, 2=disetujui");
            $table->integer('atasan')->unsigned();
            $table->string('surat_keterangan');
            $table->integer('id_perusahaan');
            $table->integer('id_karyawan');

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
        Schema::dropIfExists('h_request_cuti');
    }
}
