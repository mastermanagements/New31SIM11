<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUProfil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('u_profil', function (Blueprint $table) {
          //tambah field baru
          $table->string('fb',50)->after('telegram')->nullable();
          $table->string('ig',50)->after('fb')->nullable();
          $table->string('twitter',50)->after('ig')->nullable();
          $table->string('tiktok',50)->after('twitter')->nullable();
          $table->text('alamat')->after('foto')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('u_profil', function (Blueprint $table) {
          //rollback
          $table->dropColumn('fb');
          $table->dropColumn('ig');
          $table->dropColumn('twitter');
          $table->dropColumn('tiktok');
          $table->dropColumn('alamat');
      });
    }
}
