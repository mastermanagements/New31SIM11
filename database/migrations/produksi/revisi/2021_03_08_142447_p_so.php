<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PSo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_so', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_tawar_beli')->default(0)->nullable();
            $table->date('tgl_so');
            $table->string('no_so');
            $table->string('no_po');
            $table->integer('id_klien');
            $table->date('tgl_dikirim');
            $table->integer('diskon_tambahan')->default(0);
            $table->integer('pajak')->default(0);
            $table->decimal('desimal',12,2)->default(0);
            $table->decimal('kurang_bayar',12,2)->default(0);
            $table->text('text');
            $table->enum('status',['0','1'])->default(0);
            $table->integer('id_perusahaan')->unsigned();
            $table->foreign('id_perusahaan')->references('id')->on('u_perusahaan')->onDelete('cascade');
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
        Schema::dropIfExists('p_so');
    }
}
