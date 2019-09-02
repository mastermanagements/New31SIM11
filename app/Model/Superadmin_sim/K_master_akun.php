<?php

namespace App\Model\Superadmin_sim;

use Illuminate\Database\Eloquent\Model;

class K_master_akun extends Model
{
    //
    protected $table = 'k_master_akun';

    protected $fillable=['kode_m_akun','nm_m_akun'];

    public function manySubAkun()
    {
        return $this->hasMany('App\Model\Superadmin_sim\K_master_sub_akun','id_m_akun','id');
    }

    public function hasMannyAkunUkm(){
        return $this->hasOne('App\Model\Keuangan\Akun','id_m_akun', 'id');
    }
}
