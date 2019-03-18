<?php

namespace App\Model\Superadmin_ukm;

use Illuminate\Database\Eloquent\Model;

class U_menu_ukm extends Model
{
    //
    protected $table = "u_menu_ukm";

    protected $fillable = ['id_master_menu','id_perusahaan'];

    public function getMasterMenu()
    {
        return $this->belongsTo('App\Model\Superadmin_sim\U_master_menu','id_master_menu');
    }

    public function getSubMenu()
    {
        return $this->hasMany('App\Model\Superadmin_ukm\U_submenu_ukm','id_menu_ukm');
    }

}
