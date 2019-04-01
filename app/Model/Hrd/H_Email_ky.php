<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_Email_ky extends Model
{
    //

    protected $table = "h_email_k";
    protected $fillable = ['id_ky','nm_email','id_perusahaan','id_karyawan'];
}
