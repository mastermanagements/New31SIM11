<?php

namespace App\Model\Superadmin_ukm;

use Illuminate\Database\Eloquent\Model;

class A_misi_p extends Model
{
    //
    protected $table="a_misi_p";

    protected $fillable=['misi','id_perusahaan','id_user_ukm'];

    public function getPerusahaan()
    {
        return $this->belongsTo('App\Model\Superadmin_ukm\U_usaha','id_perusahaan');
    }
}
