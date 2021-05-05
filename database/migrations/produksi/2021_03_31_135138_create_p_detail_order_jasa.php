<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePDetailOrderJasa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_detail_order_jasa', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_order_jasa')->unsigned();
            $table->integer('id_jasa')->unsigned();
            $table->integer('id_barang')->unsigned()->nullable();
            $table->integer('qty');
            $table->integer('biaya')->unsigned();
            $table->integer('diskon')->nullable();
            $table->decimal('total_biaya',12,2);
            //$table->text('kondisi_barang')->nullable();
            $table->text('ket')->nullable();
            $table->enum('status_service',['0','1','2','3','4','5','6','7','8'])->comment('0 = baru masuk, 1 = sdg dikerjakan, 2 = lanjut service, 3 = cancel service, 4 = gagal service, 5 = berhasil service, 6 = selesai quality control, 7 = perbaikan ulang, 8 = perbaikan garansi');
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
        Schema::dropIfExists('p_detail_order_jasa');
    }
}
