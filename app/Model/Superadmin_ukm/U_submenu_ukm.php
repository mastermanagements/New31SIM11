<?php

namespace App\Model\Superadmin_ukm;

use Illuminate\Database\Eloquent\Model;

class U_submenu_ukm extends Model
{
    //
    protected $table = "u_submenu_ukm";

    protected $fillable = ['id_menu_ukm','id_master_submenu','id_perusahaan'];

    public function getMasterSubMenuUKM()
    {
        return $this->belongsTo('App\Model\Superadmin_sim\U_master_sub_menu','id_master_submenu');
    }

}
