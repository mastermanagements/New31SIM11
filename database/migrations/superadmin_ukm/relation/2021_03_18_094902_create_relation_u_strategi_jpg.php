<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationUStrategiJpg extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('u_strategi_jpg', function (Blueprint $table) {
            $table->foreign('id_tjpg')->references('id')->on('u_target_puncak')->onDelete('cascade');
            $table->foreign('id_perusahaan')->references('id')->on('u_perusahaan');
            $table->foreign('id_karyawan')->references('id')->on('h_karyawan');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table ('u_strategi_jpg', function (Blueprint $table) {
          $table->dropForeign(['id_tjpg']);
      });
    }
}
