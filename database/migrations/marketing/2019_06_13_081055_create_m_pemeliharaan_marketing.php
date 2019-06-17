<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMPemeliharaanMarketing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_pemeliharaan_marketing', function (Blueprint $table) {
            $table->increments('id');
			$table->date('tgl_menghubungi');
			$table->integer('id_barang')->unsigned()->default(0);
			$table->integer('id_jasa')->unsigned()->default(0);
			$table->integer('id_klien')->unsigned();
			$table->enum('menghubungi_via',['telp','sms','wa','telegram','fb','fb messenger','twitter','kopdar','silaturahim']);
			$table->text('pesan_marketer');
			$table->text('respon_klien');
			$table->text('tindak_lanjut');
			$table->integer('id_bagian')->unsigned()->default(0);
			$table->integer('id_divisi')->unsigned()->default(0);
			$table->enum('status_closing',['0','1']);
			$table->enum('status_percakapan',['0','1']);
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
        Schema::dropIfExists('m_pemeliharaan_marketing');
    }
}
