<?php

namespace App\Model\Superadmin_sim;

use Illuminate\Database\Eloquent\Model;

class U_master_sub_menu extends Model
{
    //

    protected $table="u_master_submenu";

    protected $fillable = ['id_master_menu','nm_submenu', 'url'];
}
