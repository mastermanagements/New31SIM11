<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMPelaksanaanMarketing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_pelaksanaan_marketing', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('id_rm_fase')->unsigned();
			$table->enum('jenis_keg_marketing',['Persiapan','Review','Publish']);
			//$table->enum('jenis_content',['Pengenalan','Branding','Penjualan']);
			$table->string('tema_content');
			//$table->dateTimeTz('tgl_keg_marketing');
			//$table->integer('id_keg_marketing')->unsigned();
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
        Schema::dropIfExists('m_pelaksanaan_marketing');
    }
}
