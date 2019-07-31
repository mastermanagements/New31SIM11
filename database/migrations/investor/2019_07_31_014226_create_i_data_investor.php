<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIDataInvestor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_data_investor', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nik');
            $table->string('nm_investor');
            $table->string('password');
            $table->string('tmp_lahir');
            $table->date('tgl_lahir');
            $table->enum('jenis_kel', ['Pria','Wanita','-'])->defautl('-');
            $table->string('agama');
            $table->enum('status_perkawinan',['Belum Kawin','Sudah Kawin','Janda', 'Duda'])->default('Belum Kawin');
            $table->string('pekerjaan')->nullable();
            $table->string('file_ktp')->nullable();
            $table->string('pas_photo')->nullable();
            $table->string('nm_bank')->nullable();
            $table->string('no_rek')->nullable();
            $table->string('pend_akhir')->nullable();
            $table->string('no_rek_bank')->nullable();
            $table->string('kantor_cabang')->nullable();
            $table->integer('id_perusahaan')->unsigned();
            $table->integer('id_karyawan')->unsigned();
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
        Schema::dropIfExists('i_data_investor');
    }
}
