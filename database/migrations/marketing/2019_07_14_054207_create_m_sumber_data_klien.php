<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMSumberDataKlien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_sumber_data_klien', function (Blueprint $table) {
            $table->increments('id');
			$table->enum('sumber_data',['0','1'])->comment('0=off line,1=on line');
			$table->string('sumber_media');
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
        Schema::dropIfExists('m_sumber_data_klien');
    }
}
