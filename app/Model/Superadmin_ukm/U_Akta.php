<?php

namespace App\Model\superadmin_ukm;

use Illuminate\Database\Eloquent\Model;

class U_Akta extends Model
{
    //
    protected $table="u_akta";

    protected $fillable=['no_akta','tgl_akta','notaris','bentuk_usaha','no_rak','file_akta','id_perusahaan','id_user_ukm'];

    public function getPerusahaan()
    {
        return $this->belongsTo('App\Model\Superadmin_ukm\U_usaha', 'id_perusahaan');
    }
}
