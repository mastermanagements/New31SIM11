<?php

namespace App\Model\Superadmin_ukm;

use Illuminate\Database\Eloquent\Model;

class U_user_ukm extends Model
{

    protected $table="u_user_ukm";
    protected $fillable = ['nama','email','password'];

}
