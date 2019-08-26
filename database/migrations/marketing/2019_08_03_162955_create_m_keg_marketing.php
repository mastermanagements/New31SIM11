<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMKegMarketing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_keg_marketing', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('id_content_marketing')->unsigned();
			$table->enum('jenis_keg_marketing',['Persiapan', 'Pelaksanaan', 'Review', 'Publish']);
			$table->string('keg_marketing');
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
        Schema::dropIfExists('m_keg_marketing');
    }
}
