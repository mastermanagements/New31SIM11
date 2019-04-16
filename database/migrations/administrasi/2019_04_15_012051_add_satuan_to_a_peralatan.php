<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSatuanToAPeralatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('a_peralatan', function (Blueprint $table) {
            //tambah field satuan
			$table->string('satuan',50)->after('nm_alat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('a_peralatan', function (Blueprint $table) {
            //rolback
			$table->dropColumn('satuan');
        });
    }
}
