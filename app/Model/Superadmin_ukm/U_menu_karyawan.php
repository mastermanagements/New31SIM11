<?php

namespace App\Model\Superadmin_ukm;

use Illuminate\Database\Eloquent\Model;

class U_menu_karyawan extends Model
{
    //

    protected $table="u_menu_karyawan";

    protected $fillable = ["id_menu_ukm","id_submenu_ukm","id_karyawan","id_user_ukm","id_perusahaan"];

    public function getSubMenuPerusahaan()
    {
        return $this->belongsTo('App\Model\Superadmin_ukm\U_submenu_ukm','id_submenu_ukm');
    }
}
