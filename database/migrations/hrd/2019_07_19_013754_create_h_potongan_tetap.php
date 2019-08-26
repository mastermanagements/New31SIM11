<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHPotonganTetap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h_potongan_tetap', function (Blueprint $table) {
            $table->increments('id');
            $table->string("nm_potongan");
            $table->string("satuan_potongan");
            $table->enum("status_potongan", [0,1])->default(0);
            $table->integer("besar_potongan");
            $table->integer("id_perusahaan")->unsigned();
            $table->integer("id_karyawan")->unsigned();
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
        Schema::dropIfExists('h_potongan_tetap');
    }
}
