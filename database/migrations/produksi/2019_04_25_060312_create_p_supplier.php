<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePSupplier extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_supplier', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_suplier');
            $table->string('cp_suplier')->nullable();
            $table->string('telp_suplier')->nullable();
            $table->string('hp_suplier')->nullable();
            $table->string('wa_suplier')->nullable();
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
        Schema::dropIfExists('p_supplier');
    }
}
