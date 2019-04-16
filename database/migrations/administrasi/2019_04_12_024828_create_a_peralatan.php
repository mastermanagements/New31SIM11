<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAPeralatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('a_peralatan', function (Blueprint $table) {
            $table->increments('id');
			$table->string('nm_alat');
			$table->integer('jumlah_alat');
			$table->string('merk')->nullable();
			$table->string('tipe')->nullable();
			$table->year('thn_buat')->nullable();
			$table->date('tgl_beli');
			$table->string('kondisi_alat');
			$table->string('bukti_kepemilikan')->nullable();
			$table->string('file_bukti')->nullable();
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
        Schema::dropIfExists('a_peralatan');
    }
}
