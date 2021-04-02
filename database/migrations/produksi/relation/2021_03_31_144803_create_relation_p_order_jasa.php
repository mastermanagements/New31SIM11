<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationPOrderJasa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('p_order_jasa', function (Blueprint $table) {
          $table->foreign('id_klien')->references('id')->on('a_klien');
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
      Schema::table('p_order_jasa', function (Blueprint $table) {

      });
    }
}
