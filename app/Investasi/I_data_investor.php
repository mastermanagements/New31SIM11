<?php

namespace App\Investasi;

use Illuminate\Database\Eloquent\Model;

class I_data_investor extends Model
{
    //
    protected $table='i_data_investor';

    protected $fillable = [
        'nik',
        'nm_investor',
        'password',
        'tmp_lahir',
        'tgl_lahir',
        'jenis_kel',
        'agama',
        'status_perkawinan',
        'pekerjaan',
        'file_ktp',
        'pas_photo',
        'nm_bank',
        'no_rek',
        'pend_akhir',
        'no_rek_bank',
        'kantor_cabang',
        'id_perusahaan',
        'id_karyawan',
    ];

    public function dataInvestasi(){
        return $this->hasMany('App\Model\Investor\DaftarInvestasi','id_investor');
    }
}
