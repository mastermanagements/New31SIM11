<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMPromoMarketing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_promo_marketing', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('id_rencana_marketing_brg')->unsigned()->default(0);
			$table->integer('id_rencana_marketing_jasa')->unsigned()->default(0);
			$table->date('tgl_promo');
			$table->date('tgl_mulai');
			$table->date('tgl_selesai');
			$table->enum('metode_marketing',['0','1']);
			$table->text('target_pengguna');
			$table->enum('media_marketing',['groups fb','fans pages','fb ads','google ads','you tube ads','groups wa','groups telegram','koran','majalah','baliho','spanduk']);
			$table->string('detail_media');
			$table->text('isi_promosi');
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
        Schema::dropIfExists('m_promo_marketing');
    }
}
