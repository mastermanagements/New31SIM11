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
			$table->integer('id_sdk')->after('jenis_klien')->nullable()->default('0');
			$table->integer('id_penanda_sdk')->after('id_sdk')->nullable()->default('0');
			$table->string('tambahan_sdk')->after('id_penanda_sdk')->nullable();
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
