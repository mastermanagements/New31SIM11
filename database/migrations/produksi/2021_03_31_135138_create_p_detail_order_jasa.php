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
            $table->text('kondisi_barang')->nullable();
            $table->text('ket')->nullable();
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
