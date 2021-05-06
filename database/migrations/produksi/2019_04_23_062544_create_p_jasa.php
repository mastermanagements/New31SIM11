<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePJasa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_jasa', function (Blueprint $table) {
          $table->increments('id');
          $table->string('nm_layanan');
          $table->integer('peritem');
          $table->integer('id_satuan')->unsigned();
          $table->integer('waktu_kerja');
          $table->integer('satuan_waktu')->unsigned();
          $table->enum('waktu_selesai',['0','1']);
          $table->decimal('biaya',12,2);
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
        Schema::dropIfExists('p_jasa');
    }
}
