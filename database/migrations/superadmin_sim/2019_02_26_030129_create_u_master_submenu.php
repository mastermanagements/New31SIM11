<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUMasterSubmenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('u_master_submenu', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_master_menu')->unsigned();
			$table->enum('kelompok_submenu',['0','1','2','3'])->comment('0=perdagangan, 1=jasa, 2=perdagangan dan jasa, 3=manufaktur');
            $table->enum('jenis_submenu',['0','1'])->comment('0=menu utama, 1=menu tambahan');
            $table->string('nm_submenu');
			$table->integer('urutan')->default('0')->nullable();
			$table->string('url');
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
        Schema::dropIfExists('u_master_submenu');
    }
}
