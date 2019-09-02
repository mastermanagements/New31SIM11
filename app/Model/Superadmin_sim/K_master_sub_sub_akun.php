<?php

namespace App\Model\Superadmin_sim;

use Illuminate\Database\Eloquent\Model;

class K_master_sub_sub_akun extends Model
{
    //
    protected $table = "k_master_subsub_akun";

    protected $fillable =[
      'id_m_sub_akun',
      'kode_m_subsub_akun',
      'nm_m_subsub_akun',
      'off_on',
    ];
}
