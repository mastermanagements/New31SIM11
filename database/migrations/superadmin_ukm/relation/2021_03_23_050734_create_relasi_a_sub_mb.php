<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelasiASubMb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('a_sub_mb', function (Blueprint $table) {
            $table->foreign('id_jenis_mb')->references('id')->on('a_jenis_mb');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('a_sub_mb', function (Blueprint $table) {

      });
    }
}
