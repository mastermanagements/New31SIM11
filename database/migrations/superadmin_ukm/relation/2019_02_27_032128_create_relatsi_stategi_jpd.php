<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelatsiStategiJpd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('u_strategi_jpd', function (Blueprint $table) {
            //
            $table->foreign('id_sjpg')->references('id')->on('u_strategi_jpg');
            $table->foreign('id_bagian_p')->references('id')->on('u_bagian_p');
            $table->foreign('id_divisi_p')->references('id')->on('u_devisi_p');
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
        Schema::table('u_strategi_jpd', function (Blueprint $table) {
            //
        });
    }
}
