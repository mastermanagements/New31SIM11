<?php

namespace App\Model\superadmin_ukm;

use Illuminate\Database\Eloquent\Model;

class U_menu_investor extends Model
{

    protected $table="u_menu_investor";

    protected $fillable = ["id_menu_ukm","id_submenu_ukm","id_investor","id_user_ukm","id_perusahaan"];

    public function getSubMenuPerusahaan()
    {
        return $this->belongsTo('App\Model\Superadmin_ukm\U_submenu_ukm','id_submenu_ukm');
    }

}
