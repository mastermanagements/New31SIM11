<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePOrderJasa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_order_jasa', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tgl_order');
            $table->integer('id_klien')->unsigned();
            //$table->enum('status_service',['0','1','2','3','4','5','6','7','8'])->comment('0 = baru masuk, 1 = sdg dikerjakan, 2 = lanjut service, 3 = cancel service, 4 = gagal service, 5 = berhasil service, 6 = selesai quality control, 7 = perbaikan ulang, 8 = perbaikan garansi');
            //$table->enum('status_service',['0','1'])->comment('0 = baru masuk, 1 = sdg dikerjakan');
            $table->enum('status_konfirm',['0','1'])->comment('0=belum konfirm ke klien,1=sudah konfirm ke klien')->nullable();
            $table->date('tgl_konfirm')->nullable();
            $table->time('jam_konfirm')->nullable();
            $table->enum('status_ambil',['0','1'])->comment('0=blm diambil, 1=sudah diambil')->nullable();
            $table->decimal('uang_muka',12,2)->nullable();
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
        Schema::dropIfExists('p_order_jasa');
    }
}
