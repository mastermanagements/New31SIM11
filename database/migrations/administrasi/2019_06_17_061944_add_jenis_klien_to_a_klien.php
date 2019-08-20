<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJenisKlienToAKlien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('a_klien', function (Blueprint $table) {
            //tambah field jenis_klien
			$table->enum('jenis_klien',['0','1'])->after('jabatan');
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
			$table->dropColumn('jenis_klien');
        });
    }
}
