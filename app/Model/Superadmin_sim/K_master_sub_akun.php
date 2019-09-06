<?php

namespace App\Model\Superadmin_sim;

use Illuminate\Database\Eloquent\Model;

class K_master_sub_akun extends Model
{
    //

    protected $table = "k_master_sub_akun";

    protected $fillable = [
        'id_m_akun',
        'kode_m_sub_akun',
        'nm_m_sub_akun',
        'off_on',
    ];

    public function manySubsub()
    {
        return $this->hasMany('App\Model\Superadmin_sim\K_master_sub_sub_akun','id_m_sub_akun','id');
    }

    public function mannySubAkunUkm()
    {
        return $this->hasMany('App\Model\Keuangan\SubAkun','id_m_sub_akun','id');
    }
}
