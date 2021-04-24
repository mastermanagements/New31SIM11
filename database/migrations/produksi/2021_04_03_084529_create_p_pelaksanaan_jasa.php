<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePPelaksanaanJasa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_pelaksanaan_jasa', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_detail_oj')->unsigned();
            $table->datetime('tgl_jam_mulai');
            $table->integer('id_proses_bisnis')->unsigned();
            $table->datetime('tgl_jam_do')->nullable();
            $table->text('what_do')->nullable();
            $table->datetime('tgl_jam_finish')->nullable();
            $table->text('what_result')->nullable();
            $table->integer('yg_mengerjakan')->unsigned();
            $table->datetime('tgl_jam_konfirm')->nullable();
            $table->text('what_respon')->nullable();
            $table->integer('yg_mengkonfirmasi')->unsigned()->nullable();
            $table->enum('status_perproses',['0','1','2','3'])->comment('1 = lanjut service, 2=cancel service, 3= gagal service, 4= berhasil service')->nullable();
            $table->enum('biaya_tambahan',['0','1'])->comment('1=no biaya tambahan, 2=yes biaya tambahan')->nullable();
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
        Schema::dropIfExists('p_pelaksanaan_jasa');
    }
}
