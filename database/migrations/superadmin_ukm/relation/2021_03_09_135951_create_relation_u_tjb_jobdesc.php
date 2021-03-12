<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationUTjbJobdesc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {

         Schema::table('u_tjb_jobdesc', function (Blueprint $table) {
           $table->foreign('id_jobdesc')->references('id')->on('u_job_desc')->onDelete('cascade');
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
       Schema::table('u_tjb_jobdesc', function (Blueprint $table) {
           //
           $table->dropForeign(['id_jobdesc']);
       });
     }
}
