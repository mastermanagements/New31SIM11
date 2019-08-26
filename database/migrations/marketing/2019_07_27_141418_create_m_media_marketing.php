<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMMediaMarketing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_media_marketing', function (Blueprint $table) {
            $table->increments('id');
			$table->enum('jenis_media',['0','1'])->comment('0=konvensional marketing', '1=digital marketing');
            $table->string('media_marketing');
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
        Schema::dropIfExists('m_media_marketing');
    }
}
