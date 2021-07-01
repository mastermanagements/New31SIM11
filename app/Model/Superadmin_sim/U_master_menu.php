<?php

namespace App\Model\Superadmin_sim;

use Illuminate\Database\Eloquent\Model;

class U_master_menu extends Model
{
    //
    protected $table = "u_master_menu";

    protected $fillable = ['kelompok_menu','jenis_menu','nm_menu'];

    public function getSubmenu()
    {
        return $this->hasMany('App\Model\Superadmin_sim\U_master_sub_menu', 'id_master_menu');
    }
}
