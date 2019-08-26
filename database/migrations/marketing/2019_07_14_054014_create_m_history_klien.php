<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMHistoryKlien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_history_klien', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('id_klien')->unsigned();
			$table->enum('jenis_klien',['0','1','2','3','4']);
			$table->date('tgl_history');
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
        Schema::dropIfExists('m_history_klien');
    }
}
