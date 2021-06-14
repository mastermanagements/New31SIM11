<?php

namespace App\Model\Keuangan;

use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    //

    protected $table = "k_akun_ukm";

    protected $fillable = ['id_m_akun','kode_akun','nm_akun','posisi_saldo','id_perusahaan','id_karyawan'];

    public function sub_akun_ukm()
    {
        return $this->hasMany('App\Model\Keuangan\SubAkun','id_akun_ukm','id');
    }
}
