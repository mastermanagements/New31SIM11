<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldToKlien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('a_klien', function (Blueprint $table) {
            //tambah field
      $table->enum('jenis_klien',['0','1'])->after('jabatan');
			$table->integer('id_sdk')->after('jenis_klien')->nullable()->default('0');
			$table->integer('id_penanda_sdk')->after('id_sdk')->nullable()->default('0');
			$table->string('tambahan_sdk')->after('id_penanda_sdk')->nullable();
      $table->integer('id_group')->after('tambahan_sdk')->unsigned()->nullable();
      $table->enum('status_diskon',['0','1'])->after('id_group')->comment('0=yes, 1=no')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('a_klien', function (Blueprint $table) {
            //rolback
			$table->dropColumn('id_sumber_data');
			$table->dropColumn('ket_sumber_data');
        });
    }
}
